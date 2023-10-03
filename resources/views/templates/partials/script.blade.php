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
                    'Aksi dibatalkan',
                    'error'
                )
            }
        });
    }
</script>

<!-- SweetAlert Confirmation Video -->
<script>
    function Delete(id) {
        Swal.fire({
            title: 'Apakah Kamu Yakin',
            text: "Kamu akan menghapus video ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete route with the item's ID
                window.location.href = "/video/" + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Aksi dibatalkan',
                    'error'
                )
            }
        });
    }
</script>

<!-- SweetAlert Confirmation Galery -->
<script>
    function DeleteGalery(id) {
        Swal.fire({
            title: 'Apakah Kamu Yakin',
            text: "Kamu akan menghapus gambar ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete route with the item's ID
                window.location.href = "/galery/" + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Aksi dibatalkan',
                    'error'
                )
            }
        });
    }
</script>

<!-- SweetAlert Confirmation Wisata -->
<script>
    function DeleteWisata(id) {
        Swal.fire({
            title: 'Apakah Kamu Yakin',
            text: "Kamu akan menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete route with the item's ID
                window.location.href = "/wisata/" + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Aksi dibatalkan',
                    'error'
                )
            }
        });
    }
</script>

<!-- SweetAlert Confirmation Wisata -->
<script>
    function DeleteKuliner(id) {
        Swal.fire({
            title: 'Apakah Kamu Yakin',
            text: "Kamu akan menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete route with the item's ID
                window.location.href = "/kuliner/" + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Aksi dibatalkan',
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