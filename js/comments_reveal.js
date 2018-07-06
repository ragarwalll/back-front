<script>
$(document).ready(function() {

  $('.comment<?php echo $id;?>').click(function() {
    $('.comments_reveal<?php echo $id;?>').toggleClass('open')
  })

})
</script>
