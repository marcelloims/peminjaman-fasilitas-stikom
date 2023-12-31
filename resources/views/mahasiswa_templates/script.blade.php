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

<!-- Daterangepicker -->
<!-- momment js is must -->
<script src="{{ asset('assets/vendor/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- clockpicker -->
<script src="{{ asset('assets/vendor/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
<!-- asColorPicker -->
<script src="{{ asset('assets/vendor/jquery-asColor/jquery-asColor.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-asGradient/jquery-asGradient.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js') }}"></script>
<!-- Material color picker -->
<script src="{{ asset('assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
<!-- pickdate -->
<script src="{{ asset('assets/vendor/pickadate/picker.js') }}"></script>
<script src="{{ asset('assets/vendor/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('assets/vendor/pickadate/picker.date.js') }}"></script>



<!-- Daterangepicker -->
<script src="{{ asset('assets/js/plugins-init/bs-daterange-picker-init.js') }}"></script>
<!-- Clockpicker init -->
<script src="{{ asset('assets/js/plugins-init/clock-picker-init.js') }}"></script>
<!-- asColorPicker init -->
<script src="{{ asset('assets/js/plugins-init/jquery-asColorPicker.init.js') }}"></script>
<!-- Material color picker init -->
<script src="{{ asset('assets/js/plugins-init/material-date-picker-init.js') }}"></script>
<!-- Pickdate -->
<script src="{{ asset('assets/js/plugins-init/pickadate-init.js') }}"></script>
{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://127.0.0.1:8000/mahasiswa/ukm',
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
