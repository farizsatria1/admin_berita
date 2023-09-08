<!-- Libs JS -->
<script src="./dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
<script src="./dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062" defer></script>
<script src="./dist/libs/jsvectormap/dist/maps/world.js?1684106062" defer></script>
<script src="./dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062" defer></script>
<!-- Tabler Core -->
<script src="./dist/js/tabler.min.js?1684106062" defer></script>
<script src="./dist/js/demo.min.js?1684106062" defer></script>


<!-- SweetAlert Confirmation -->
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Kamu Yakin',
            text: "Kamu akan menghapus berita ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete route with the item's ID
                window.location.href = "/berita/" + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        });
    }
</script>

<!-- Preview Image -->
<script>
    function previewImage(event, previewId){
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function (){
            var preview = document.getElementById(previewId);
            preview.src = reader.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
</script>