<?php

use App\core\Assets;
?>
<footer class="bg-dark text-light py-4 " style="margin-top: 10px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Connect with Us</h4>
                <ul class="list-unstyled">
                    <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Contact Us</h4>
                <p>Email: contact@example.com</p>
                <p>Phone: +1 (123) 456-7890</p>
            </div>
        </div>
    </div>
</footer>



<script src="<?php Assets::assets('assets/js/jquery-3.5.1.slim.min.js'); ?>"></script>
<script src="<?php Assets::assets('assets/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php Assets::assets('assets/js/popper.min.js'); ?>"></script>
<script src="<?php Assets::assets('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php Assets::assets('assets/js/color-modes.js'); ?>"></script>

<!-- prevent multiple submit button -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const submitButtons = document.querySelectorAll('.multiple-submit');
        let isButtonClicked = false;
        submitButtons.forEach(submitButton => {
            submitButton.addEventListener('click', function (event) {
                if (!isButtonClicked) {
                    // Set the flag to true to prevent further clicks
                    isButtonClicked = true;
                    // Optionally, if you want to re-enable the button after a delay:
                    setTimeout(function () {
                        isButtonClicked = false;
                    }, 1000); // Enable the button after 1 second
                } else {
                    // Prevent the default behavior of the button (e.g., form submission)
                    event.preventDefault();
                }
            });
        });
    });
</script>




</body>

</html>