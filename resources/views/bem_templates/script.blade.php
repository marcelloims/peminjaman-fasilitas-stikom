<script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/js/deznav-init.js') }}"></script>
<!-- Datatable -->
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
{{-- Sweet Alert --}}
<script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
{{-- myScript --}}
<script src="{{ asset('assets/js/myScript.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://127.0.0.1:8000/bem/ukm',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var ukms = data;

                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ukms.map((ukm) => [ukm.name]),
                        datasets: [{
                            label: '# of Votes',
                            data: ukms.map((ukm) => [ukm.total]),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Diagram Jumlah Pengajuan Peminjaman Fasilitas'
                            }
                        }
                    },
                });
            }
        });
    });
</script>
