
<!-- Variables -->
<?php
$footer_copyright = get_field('footer_copyright');
$footer_text = get_field('footer_text');
$footer_email = get_field('footer_email');
$footer_phone = get_field('footer_phone');
$footer_info = get_field('footer_info');
?>

<div class="container-fluid footer">
        <hr class="hr hr_footer">
        <div class="row footer_text_section">
                <div class="col-4">
                    <p class="footer_left"><?php echo $footer_copyright;?></p>
                </div>
                <div class="col-4">
                    <p class="footer_center"><?php echo $footer_text;?></p>
                </div>
                <div class="col-4">
                    <p class="footer_right"><?php echo $footer_email;?>&nbsp;&#124;&nbsp;<?php echo $footer_phone;?></p>
                    <p class="footer_right"><?php echo $footer_info;?></p>
                </div>
        </div>
</div>



 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>