<?php

use App\core\Assets;
?>
<style>


</style>
<footer class="footer">
    <div class="top-footer">
        <div class="footer-log"><i class="fa-solid fa-bolt"><span class="flash">Flash</span></i> </div>
        <div class="footer-media">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
    </div>
    <div class="footer-container">
        <div class="social-media">
            <div class="facebook"><a href="#">Facebook</a></div>
            <div class="twitter"><a href="#">Twitter</a></div>
            <div class="instagram"><a href="#">Instagram</a></div>
        </div>
        <div class="services">
            <div><a href="@">Contact</a></div>
            <div><a href="@">Our Services</a></div>
            <div><a href="@">Mode Details</a></div>
        </div>
        <div class="services">
            <div><a href="@">Contact</a></div>
            <div><a href="@">Our Services</a></div>
            <div><a href="@">Mode Details</a></div>
        </div>
    </div>
</footer>


<!-- prevent multiple submit button -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitButtons = document.querySelectorAll('.multiple-submit');
        let isButtonClicked = false;
        submitButtons.forEach(submitButton => {
            submitButton.addEventListener('click', function(event) {
                if (!isButtonClicked) {
                    // Set the flag to true to prevent further clicks
                    isButtonClicked = true;
                    // Optionally, if you want to re-enable the button after a delay:
                    setTimeout(function() {
                        isButtonClicked = false;
                    }, 1000); // Enable the button after 1 second
                } else {
                    // Prevent the default behavior of the button (e.g., form submission)
                    event.preventDefault();
                }
            });
        });
    });
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

</script>

<script src="<?php Assets::assets('assets/js/jquery-3.7.1.min.js'); ?>"></script>
<script src="<?php Assets::assets('assets/js/popper.min.js'); ?>"></script>
<script src="<?php Assets::assets('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php Assets::assets('assets/js/bootstrap.bundle.min.js'); ?>"></script>

</body>

</html>