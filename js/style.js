function cierre() {
    jQuery.ajax({url: "cierre.php", success: function(result){
        jQuery("head").append(result);
    }});
} 
    