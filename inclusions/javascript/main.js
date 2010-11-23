//  *************** Animation pour les sondages ***************
	
function printChart(container, text, name, haut, droite, bas, gauche, left, bottom, right, top, data, legend, exporting, dataLabels){

	var chart;
	chart = new Highcharts.Chart({
		chart: {
			renderTo: container,
			defaultSeriesType: 'pie',
			margin: [haut, droite, bas, gauche]
		},
		title: {
			text: text
		},
		plotArea: {
			shadow: null,
			borderWidth: null,
			backgroundColor: null
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: dataLabels,
					formatter: function() {
						if (this.y > 5) return this.point.name;
					},
					color: 'white',
					style: {
						font: '13px Trebuchet MS, Verdana, sans-serif'
					}
				}
			}
		},
		legend: {
			enabled: legend,
			layout: 'vertical',
			style: {
				left: left, 
				bottom: bottom, 
				right: right, 
				top: top,
			}
		},
		exporting: {
			enabled: exporting,
		},
		series: [{
			name: name,
			data: data
		}]
	});
	
}

jQuery(document).ready(function() {

	//  *************** Animation des événements ***************
	
	var inscriptionEventEnCours = 0;
	
	function inscrireOuPasEvent(parent, event){
		if(inscriptionEventEnCours == 0){
			inscriptionEventEnCours = 1;
			jQuery.ajax({ type: "GET", 
				url: "participationEvenementsAjax.php?evenement="+event.attr('title')+"&action="+event.attr('class'),
    			success:function(data){
        			parent.html(data);
        		
        			jQuery.ajax({ type: "GET", 
						url: "participationEvenementsAjax.php?evenement="+event.attr('title')+"&action=participants",
    					success:function(data){
        					jQuery("#participants_"+event.attr('title')).html(data);
        				}
    				});
    				
    				jQuery.ajax({ type: "GET", 
						url: "participationEvenementsAjax.php?evenement="+event.attr('title')+"&action=printparticipants",
    					success:function(data){
        					jQuery("#ilsparticipent_"+event.attr('title')).html(data);
        				}
    				});
    				
    				inscriptionEventEnCours = 0;
        		
        			jQuery(".event_header p span span").click(function(){
						inscrireOuPasEvent(jQuery(this).parent(), jQuery(this));
					});
        		}
    		});
		}
	}
	
	jQuery(".event_header p span span").click(function(){
		inscrireOuPasEvent(jQuery(this).parent(), jQuery(this));
	});

	// *************** Uploadify pour la page propoderDocument.php ***************
	
	var firstUpload = 0;
		
	jQuery('#file_upload').uploadify({
    	'uploader'  : 'inclusions/javascript/uploadify/uploadify.swf',
    	'script'    : 'inclusions/javascript/uploadify/uploadify.php',
    	'cancelImg' : 'inclusions/javascript/uploadify/cancel.png',
    	'buttonImg' : 'images/select_file.jpg',
    	'folder'    : '/uploads',
    	'sizeLimit' : 10485760,
    	'onComplete'  : function(event, ID, fileObj, response, data) {
    		var matiere = jQuery("#file_matiere").val();
    		var nom = jQuery("#file_name").val();
      		jQuery.ajax({ type: "GET", 
				url: "ajoutDocumentAjax.php?chemin="+fileObj.name+"&nom="+nom+"&matiere="+matiere,
    			success:function(retour){
        		}
    		});
    		jQuery("#file_matiere").val(1);
    		jQuery("#file_name").val("");
    		firstUpload = 0;
    		jQuery("#proposerDocument h2 div").hide();
    		jQuery("#texteProposer")
    			.html("<span style='color:green'>Votre document a bien été proposé. Il sera validé (ou pas) par les administrateurs.</span>");
    	}, 
    	'onOpen'    : function(event,ID,fileObj) {
    		if(firstUpload == 0){
    			jQuery("#proposerDocument h2 div").show();
    			firstUpload = 1;
    		}
    	},
    	'onError'     : function (event,ID,fileObj,errorObj) {
      		jQuery("#texteProposer")
      			.html("<span style='color:red'>Une erreur est survenue lors de l'upload. Veuillez recommencer s'il vous plait. La taille maximum d'un fichier est de 10Mo.</span>");
    	}
 	});
 	
 	jQuery("#button_file_upload").click(function(){
 		jQuery('#file_upload').uploadifyUpload();
 	});

	// *************** Jquery UI pour la page Documents ***************
	
	jQuery(".choix_promo").click(function(){
	
		jQuery.ajax({ type: "GET", 
			url: "documentsAjax.php?section=matieres&promo="+jQuery(this).text(),
    		success:function(data){
        		jQuery("#liste_matieres").html(data);
        		jQuery(".matiere").click(function(){
					afficherDocuments(jQuery(this).attr('title'));
					jQuery("#matiere_en_cours").html(jQuery(this).text());
				});
        	}, beforeSend:function(){
        		jQuery("#liste_matieres").html("<p style='text-align:center;'><img src='images/ajax-loader2.gif'/></p>");
        	}
    	});
		
	});
	
	function afficherDocuments(matiere_id){
		
		jQuery.ajax({ type: "GET", 
			url: "documentsAjax.php?section=documents&matiere="+matiere_id,
    		success:function(data){
        		jQuery("#liste_documents").html(data);
        		jQuery( ".document" ).draggable({
					appendTo: "body",
					helper: "clone"
				});
				jQuery( ".document" ).dblclick(function(){
					jQuery.ajax({ type: "GET", 
						url: "documentsAjax.php?section=ddl&document="+jQuery(this).attr('title'),
    					success:function(data){
    						window.location.replace(data);
    					}
        			});
    			});					
        	}, beforeSend:function(){
        		jQuery("#liste_documents").html("<p style='text-align:center;'><img src='images/ajax-loader2.gif'/></p>");
        	}
    	});
	
	}
	
	jQuery(".matiere").click(function(){
	
		afficherDocuments(jQuery(this).attr('title'));
		jQuery("#matiere_en_cours").html(jQuery(this).text());
	
	});
	
	jQuery("#liste_telechargements").droppable({
		activeClass: "liste_telechargements_active",
		hoverClass: "liste_telechargements_hover",
		accept: ".document",
		drop: function( event, ui ) {
			jQuery( this ).find( ".placeholder" ).remove();
			jQuery( "<li title='"+ui.draggable.attr("title")+"'></li>" ).text( ui.draggable.text() ).appendTo( this );
		}
	});
	
	jQuery("#bouton_telecharger").click(function(){
	
		if(jQuery("#liste_telechargements li").size() != 0){
		
			var documents = ""; 
	
			jQuery("#liste_telechargements li").each(function(){
				documents = documents + jQuery(this).attr("title") + "a"; 
			});
		
			jQuery.ajax({ type: "GET", 
				url: "documentsAjax.php?section=telechargements&documents=" + documents.substring(0, documents.length - 1),
    			success:function(data){
    				if(data != ""){
    					window.location.replace(data);
    					viderTelechargements();
    					jQuery(".loaderTelechargement").hide();
    				}
        		}, beforeSend:function(){
        			jQuery(".loaderTelechargement").show();
        		}
    		});
		
		}
	
	});
	
	function viderTelechargements(){
		jQuery("#liste_telechargements")
		.html('<span class="placeholder">Drag&Dropper ici les fichiers que vous voulez télécharger.</span>');
	}
	
	jQuery("#bouton_vider").click(function(){
		viderTelechargements();
	});
	
	jQuery("#bouton_proposer").click(function(){
		window.location.replace("proposerDocument.php");
	})

	// *************** Animation pour les input text ***************
	
	function textReplacement(input){
		var originalvalue = input.val();
 
 		input.focus( function(){
 			if( $.trim(input.val()) == originalvalue ){ input.val(''); }
 		});
 		
 		input.blur( function(){
  			if( $.trim(input.val()) == '' ){ input.val(originalvalue); }
 		});
	}	
	
	textReplacement(jQuery("#connexion input[name=idbooster]"));
	textReplacement(jQuery("#connexion input[name=pass]"));
	textReplacement(jQuery("#recherche_student input[name=recherche_student]"));
	
	// *************** Ajax pour l'affichage d'un profil après recherche ***************
	
	function afficherProfile(id){
		jQuery.ajax({ type: "GET", 
			url: "affichageProfileStudentAjax.php?idbooster="+id,
    		success:function(data){
        		jQuery("#profile_student").html(data);
        		jQuery("#profile_student #compte_infos img").click(function(){
					afficherInformationsSociales(jQuery(this).attr('title'));
				});
        	}, beforeSend:function(){
        		jQuery("#profile_student").html("<br/><br/><br/><p style='text-align:center;'><img src='images/ajax-loader.gif'/></p>");
        	}
    	});
	}
	
	jQuery(".students_found").click(function(){
	
		afficherProfile(jQuery(this).attr('title'));
	
	});
	
	function afficherInformationsSociales(icone){
		
		jQuery("#resultats_sociaux").html(jQuery("#compte_infos input[name="+ icone +"]").val());		
	
	}
	
	jQuery("#profile_student #compte_infos img").click(function(){
	
		afficherInformationsSociales(jQuery(this).attr('title'));
	
	});
	
	// *************** Ajax pour la recherche d'un student ***************
	
	var countAjaxRecherche = 0;
	
	function rechercheStudent(initial){
		var actuelCountAjaxRecherche = ++countAjaxRecherche;
		jQuery.ajax({ type: "GET", 
			url: "rechercheStudentAjax.php?recherche="+jQuery("#recherche_student input[name=recherche_student]").val()+"&initial="+initial,
    		success:function(data){
    			if(actuelCountAjaxRecherche == countAjaxRecherche){
        			jQuery("#resultat_recherche").html(data);
    			}
    			jQuery(".students_found").click(function(){
					afficherProfile(jQuery(this).attr('title'));
				});
				
        	}, beforeSend:function(){
        		jQuery("#resultat_recherche").html("<p style='text-align:center;'><img src='images/ajax-loader.gif'/></p>");
        	}
    	});
	}
	
	jQuery("#recherche_student input[name=recherche_student_button]").click(function(){
		rechercheStudent();
	})
	
	jQuery("#recherche_student input[name=recherche_student]").keyup(function(){
		rechercheStudent();
	});	
	
	rechercheStudent("true");
	

	// *************** Animation des encarts ***************
		
	jQuery(".encart").stop().hover(function(){
		jQuery(this).children().stop().fadeTo(400, 1);
	}, function(){ 
		jQuery(this).children().stop().fadeTo(400, 0); 
	});
	
	
	// *************** animation pour l'edition des informations ***************
	
	var demandeModifs = false;
	
	jQuery("#editer_informations").click(function(){
		if(demandeModifs == false){
			jQuery(this).html("<input type='submit' value='Enregistrer'/>");
			jQuery("#mesinformations form span strong").each(function(){
				jQuery(this).html('<input type="text" value="'+jQuery(this).html()+'" name="'+jQuery(this).attr('title')+'"/>');
			})	
			demandeModifs = true;
		}
	});
	
	jQuery("#changer_mdp").click(function(){
		jQuery("#compte_infos").hide();
		jQuery("#mdp").show();
		jQuery(this).html("<input type='submit' value='Enregistrer'/>");
		jQuery("#moncompte h2 input").click(function(){
			jQuery("#moncompte form").submit();
		});
	});




  // ............................ JS Page entraide ........................... 
  
  	function ouvrirFermerDetails(parent, currdet) {

		parent.slideToggle(300);
		currdet.toggle();
		
	}
	
	jQuery(".detailquestion").click(function(){
				ouvrirFermerDetails(jQuery(this).parent().find('.details'), jQuery(this).parent().find('.detailquestion'));
	});
	
	
	
			$('#form_question input').focus(function() {
				if ($("#form_question input").val() == "Entrez votre Question ici...") {
			 	$("#form_question input").val('');
			  	}
			});
	
	
			
		jQuery(".submitquestion").click(function(){	
		jQuery("#form_question").submit();
		});
		
		jQuery(".valid").click(function(){	
		jQuery(this).parent().submit();
		});


//****************************   Sondage ***************************/


					
});
