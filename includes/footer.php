    <!--start footer-->
           <footer class="footer">
            <div class="footer-text">
               Copyright © <?= date('Y'); ?> Cyber Ghost (Afolabi Temidayo Timothy), All right reserved.
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
        var interest = parseInt(amount) * (0.05);
        var total = parseInt(amount) + parseInt(interest);

        document.getElementById('total').value = total;

    }
    </script>

  </body>
</html>