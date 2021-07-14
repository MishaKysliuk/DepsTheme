jQuery(document).ready(function($) {
  
  if (typeof acf != 'undefined') {

    getRelationshipItems();

    acf.getField('field_605c48ca9b28b').on('change', function(){
      getRelationshipItems()
    });
    
    function getRelationshipItems() {
      let idList = []
      $('.id-lists').remove()
      $('.values-list > li > input').each(function() {
        idList.push($( this ).val());
      });
      $('.acf-field-605c48ca9b28b label').after("<span class='id-lists'><b>ID:</b> <span class='copyListID' title='Click to copy text.'>"+idList.join(", ")+"</span></span>")
      
      let copyListID = $('.copyListID')
      copyListID.on('click', () => {
        let $temp = $("<input>");
        $("body").append($temp);
        $temp.val(copyListID.text()).select();
        document.execCommand("copy");
        $temp.remove();
      })
    }

  }

})



