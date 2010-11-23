jQuery(document).ready(function() {

	// animation la gestion des events et entraide
	
	jQuery("#editer_evenements input[name=date]").datepicker({ dateFormat: 'yy-mm-dd' });
	
	jQuery("#liste_evenements .modifier_event").click(function(){
		jQuery.ajax({ type: "GET", 
			url: "editerEvenementAjax.php?id="+jQuery(this).attr('title'),
    		success:function(data){
				jQuery("#edition_event").html(data);
				jQuery("#editer_evenements input[name=date]").datepicker({ dateFormat: 'yy-mm-dd' });
        	}
    	});
	
	});
	
	
		jQuery(".modifier_entraide").click(function(){
			
		jQuery.ajax({ type: "GET", 
			url: "editerEntraideAjax.php?id="+jQuery(this).attr('title'),
    		success:function(data){
				jQuery("#edition_event").html(data);
				jQuery("#editer_evenements input[name=date]").datepicker({ dateFormat: 'yy-mm-dd' });
        	}
    	});
	
	});
	
	jQuery("#liste_evenements h2 div").click(function(){
		jQuery.ajax({ type: "GET", 
			url: "editerEvenementAjax.php?creation=true",
    		success:function(data){
				jQuery("#edition_event").html(data);
				jQuery("#editer_evenements input[name=date]").datepicker({ dateFormat: 'yy-mm-dd' });
        	}
    	});
	
	});

	// animation pour la partie Gestion des students
	
	function textReplacement(input){
		var originalvalue = input.val();
 
 		input.focus( function(){
 			if( $.trim(input.val()) == originalvalue ){ input.val(''); }
 		});
 		
 		input.blur( function(){
  			if( $.trim(input.val()) == '' ){ input.val(originalvalue); }
 		});
	}	
	
	textReplacement(jQuery("#recherche_student input[name=recherche_student]"));
	
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
        		jQuery("#resultat_recherche").html("<p style='text-align:center;'><img src='../images/ajax-loader.gif'/></p>");
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
	
	var modificationEnCours = 0;
	
	function afficherProfile(id){
		jQuery.ajax({ type: "GET", 
			url: "gestionStudentAjax.php?idbooster="+id,
    		success:function(data){
        		jQuery("#profile_student").html(data);
        		jQuery("#initPass input").click(function(){
					initPass(jQuery(this).attr('title'));
				});
								
				// ------------- PROMOTION
	
				jQuery("#EditPromotion").dblclick(function(){
					if(modificationEnCours == 0){
						modificationEnCours = 1;
						if(jQuery(this).html() == "B3"){
							jQuery(this).html("<select><option value='B1'>B1</option><option value='B2'>B2</option><option selected='selected' value='B3'>B3</option></select>");
						} else if(jQuery(this).html()=="B2"){
							jQuery(this).html("<select><option value='B1'>B1</option><option selected='selected' value='B2'>B2</option><option value='B3'>B3</option></select>");
						} else{
							jQuery(this).html("<select><option value='B1'>B1</option><option value='B2'>B2</option><option value='B3'>B3</option></select>");
						}	
						jQuery("#EditPromotion select").focus();	
						jQuery("#EditPromotion select").blur(function(){
							jQuery(this).parent().html(jQuery(this).val());
			
							jQuery.ajax({ type: "GET", 
								url: "editionStudentAjax.php?idbooster="+jQuery('#boosterEdit').html()+"&what=promo&new="+jQuery(this).val(),
    							success:function(data){
    								modificationEnCours = 0;
        						}
    						});	
						});
					}
				});
	
				// ------------- AUTORISATION
	
				jQuery("#EditVisites").dblclick(function(){
					if(modificationEnCours == 0){
						modificationEnCours = 1;
						jQuery(this).html("<input type='text' value='"+jQuery(this).html()+"'/>");
						jQuery("#EditVisites input").blur(function(){
							jQuery(this).parent().html(jQuery(this).val());
			
							jQuery.ajax({ type: "GET", 
							url: "editionStudentAjax.php?idbooster="+jQuery('#boosterEdit').html()+"&what=visites&new="+jQuery(this).val(),
    							success:function(data){
    								modificationEnCours = 0;
        						}
    						});	
						});
					}
				});
	
				// ------------- VISITES
		
				jQuery("#EditAutorisation").dblclick(function(){
					if(modificationEnCours == 0){
						modificationEnCours = 1;
						if(jQuery(this).html() == "2"){
							jQuery(this).html("<select><option value='0'>Bloqué</option><option value='1'>Étudiant</option><option selected='selected' value='2'>Administrateur</option></select>");
						} else if(jQuery(this).html()=="1"){
							jQuery(this).html("<select><option value='0'>Bloqué</option><option selected='selected' value='1'>Étudiant</option><option value='2'>Administrateur</option></select>");
						} else{
							jQuery(this).html("<select><option value='0'>Bloqué</option><option value='1'>Étudiant</option><option value='2'>Administrateur</option></select>");
						}
						jQuery("#EditAutorisation select").focus();
						jQuery("#EditAutorisation select").blur(function(){
							jQuery(this).parent().html(jQuery(this).val());
			
							jQuery.ajax({ type: "GET", 
								url: "editionStudentAjax.php?idbooster="+jQuery('#boosterEdit').html()+"&what=autorisation&new="+jQuery(this).val(),
    							success:function(data){
    								modificationEnCours = 0;
        						}
    						});	
						});
					}
				});
								
				
        	}, beforeSend:function(){
        		jQuery("#profile_student").html("<br/><br/><br/><p style='text-align:center;'><img src='../images/ajax-loader.gif'/></p>");
        	}
    	});
	}
	
	jQuery(".students_found").click(function(){
	
		afficherProfile(jQuery(this).attr('title'));
	
	});
		
		// ------------- PROMOTION
	
	jQuery("#EditPromotion").dblclick(function(){
		if(modificationEnCours == 0){
			modificationEnCours = 1;
			if(jQuery(this).html() == "B3"){
				jQuery(this).html("<select><option value='B1'>B1</option><option value='B2'>B2</option><option selected='selected' value='B3'>B3</option></select>");
			} else if(jQuery(this).html()=="B2"){
				jQuery(this).html("<select><option value='B1'>B1</option><option selected='selected' value='B2'>B2</option><option value='B3'>B3</option></select>");
			} else{
				jQuery(this).html("<select><option value='B1'>B1</option><option value='B2'>B2</option><option value='B3'>B3</option></select>");
			}
			jQuery("#EditPromotion select").focus();	
			jQuery("#EditPromotion select").blur(function(){
				jQuery(this).parent().html(jQuery(this).val());
			
				jQuery.ajax({ type: "GET", 
					url: "editionStudentAjax.php?idbooster="+jQuery('#boosterEdit').html()+"&what=promo&new="+jQuery(this).val(),
    				success:function(data){
    					modificationEnCours = 0;
        			}
    			});	
			});
		}
	});
	
		// ------------- AUTORISATION
	
	jQuery("#EditVisites").dblclick(function(){
		if(modificationEnCours == 0){
			modificationEnCours = 1;
			jQuery(this).html("<input type='text' value='"+jQuery(this).html()+"'/>");
			jQuery("#EditVisites input").blur(function(){
				jQuery(this).parent().html(jQuery(this).val());
			
				jQuery.ajax({ type: "GET", 
					url: "editionStudentAjax.php?idbooster="+jQuery('#boosterEdit').html()+"&what=visites&new="+jQuery(this).val(),
    				success:function(data){
    					modificationEnCours = 0;
        			}
    			});	
			});
		}
	});
	
		// ------------- VISITES
		
	jQuery("#EditAutorisation").dblclick(function(){
		if(modificationEnCours == 0){
			modificationEnCours = 1;
			if(jQuery(this).html() == "2"){
				jQuery(this).html("<select><option value='0'>Bloqué</option><option value='1'>Étudiant</option><option selected='selected' value='2'>Administrateur</option></select>");
			} else if(jQuery(this).html()=="1"){
				jQuery(this).html("<select><option value='0'>Bloqué</option><option selected='selected' value='1'>Étudiant</option><option value='2'>Administrateur</option></select>");
			} else{
				jQuery(this).html("<select><option value='0'>Bloqué</option><option value='1'>Étudiant</option><option value='2'>Administrateur</option></select>");
			}
			jQuery("#EditAutorisation select").focus();
			jQuery("#EditAutorisation select").blur(function(){
				jQuery(this).parent().html(jQuery(this).val());
			
				jQuery.ajax({ type: "GET", 
					url: "editionStudentAjax.php?idbooster="+jQuery('#boosterEdit').html()+"&what=autorisation&new="+jQuery(this).val(),
    				success:function(data){
    					modificationEnCours = 0;
        			}
    			});	
			});
		}
	});

	function initPass(idbooster){
		jQuery.ajax({ type: "GET", url: "initStudentPassAjax.php?idbooster="+idbooster,
			success:function(data){
				jQuery("#newPass").html(data);
			}, beforeSend:function(){
        		jQuery("#newPass").html("<img src='../images/ajax-loader.gif'/>");
        	}
        });
	}

	jQuery("#initPass input").click(function(){
		initPass(jQuery(this).attr('title'));
	});
	
	// animation pour la partie Gestion des documents
	
	var modificationEnCours = 0;
	
	jQuery(".nomDocument").dblclick(function(){
		if(modificationEnCours == 0){
			var id = jQuery(this).attr('title');
			jQuery(this).html('<input type="text" value="'+ jQuery(this).html() +'"/>');
			modificationEnCours = 1;
			jQuery(".nomDocument input").blur(function(){
				jQuery(this).parent().html(jQuery(this).val());
				
				jQuery.ajax({ type: "GET", 
					url: "gestionDocumentsAjax.php?action=modifier&id="+id+"&new="+jQuery(this).val(),
    				success:function(data){
    					modificationEnCours = 0;
        			}
    			});				
				
			});
		}
	}); 

	// animation pour les encarts 
	
	jQuery(".encart").stop().hover(function(){
		jQuery(this).children().stop().fadeTo(400, 1);
	}, function(){ 
		jQuery(this).children().stop().fadeTo(400, 0); 
	});

	//  administration des SONDAGES
				
	var nbroption = jQuery(".nbroption").size() - 1;
	var info = false;	

	jQuery( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	
	jQuery(".moins").click(function(){
		if(nbroption == 1){ 
			if(info == false){
				jQuery(this).after(' <span style="color:red">Il faut au moins deux options !</span>'); 
				info = true;
			} 
		} else { 
			jQuery("#options div:last").remove();
			nbroption--;
		};
	});
				
	jQuery(".plus").click(function(){
		nbroption++;
		var displayopt = nbroption + 1;
		jQuery("#options").append('<div>Choix ' + displayopt + ' : <input name="opt[' + nbroption + ']" type="text" /><br /></div>');
	});
				 
	jQuery("#formsondage").submit(function() {
		var dataString = 'choix='+ nbroption;
		
		jQuery.ajax({
			type: "POST",
			url: "sondages.php?action=ajouter",
			data: nbroption,
			success: function() {

			}
		});	
						
	});

});