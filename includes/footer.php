    <!--start footer-->
           <footer class="footer">
            <div class="footer-text">
               Copyright © <?= date('Y'); ?> Cyber Ghost, All right reserved.
            </div>
            </footer>
          <!--end footer-->

         <!--Start Back To Top Button-->
             <a href="javaScript:;" class="back-to-top"><i class="fa fa-arrow-up"></i></a>
         <!--End Back To Top Button-->

         <!--start overlay-->
          <div class="overlay"></div>
         <!--end overlay-->

     </div>
  <!--end wrapper-->
    <!-- JS Files-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../../../../unpkg.com/ionicons%405.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!--plugins-->
    <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/chartjs/chart.min.js"></script>
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/js/table-datatable.js"></script>
    <script src="../assets/js/index3.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/js/form-select2.js"></script>
    <!-- Main JS-->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/plugins/OwlCarousel/js/owl.carousel.min.js"></script>
    <script src="../assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js"></script>
    <script src="../assets/js/product-details.js"></script>
    <script src="../assets/js/fontawesome.js"></script>

    <script>
     function getTotal(){

        var amount = document.getElementById('amount').value;
        var interest = parseInt(amount) * (4 / 100);
        var total = parseInt(amount) + parseInt(interest);

        document.getElementById('total').value = total;

    }
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.payamount', function(e) {
                e.preventDefault();

                var amount = $('.total').val();
                var type = $(this).data('type');
                var email = "<?= $getCustomer->email; ?>";
                var name = "<?= $getCustomer->surname; ?>";

                alert(amount + ' ' + type + ' ' + email + ' ' + name);

                // function payWithPaystack(type, email, name){

                //     var handler = PaystackPop.setup({
                //       key: 'pk_test_cad279c5049ebec698669f5d2d765aee8a95630b',
                //       email: email,
                //       name: name,
                //       amount: (amount) * 100,
                //       currency: 'NGN',
                //       ref: '<?php echo substr(sha1(uniqid()), 4, 9); ?>' + Math.floor((Math.random() * 1000000000) + 1),
                //       callback: function(response){
                //           alert('Your transaction ref is ' + response.reference +'\nPlease you will be redirect to a page. Please wait for some minutes...');
                //           window.location = `${type}_verify?reference=` + response.reference;
                //       },
                //       onClose: function(){
                //         window.location = "fund-wallet?transaction=call";
                //         alert('Transaction Cancelled');
                //     }
                // });
                //     handler.openIframe();
                // }

                payWithPaystack(type, email, name);

            });
        });
    </script>


  </body>
</html>