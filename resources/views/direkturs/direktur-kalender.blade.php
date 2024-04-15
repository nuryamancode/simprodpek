@extends('direkturs.layouts.direktur-base', ['title' => 'Kalender Proyek'])


@section('content-direktur')
    <style>
        .fc-event {
            cursor: pointer;
        }


        #tabelacara {
            display: none;
        }
    </style>
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h2 class="main-title" id="name-title">Kalender Proyek</h2>
                    </div>
                    <div class="col text-end">
                        <a href="#" class="btn btn-primary" data-bs-target="#tambahModal" data-bs-toggle="modal">
                            <i class="bi bi-calendar2-plus-fill"></i>
                            Tambah Acara
                        </a>
                        <a href="#" class="btn btn-danger" id="toggleButton">
                            <i class="bi bi-calendar2-event-fill"></i>
                            Hapus Acara
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="kalender">
                    <button type="button" class="btn btn-dark" id="calendarButton">
                        <i class="bi bi-calendar2-month-fill"></i> Grid</button>
                    <div class="calendar mt-3" id="calendar"></div>
                </div>
                <div id="tabelacara">
                    <table class="table table-responsive table-striped table-bordered mt-3" style="width:100%">
                        <thead>
                            <tr class="text-center text-nowrap align-middle table-dark">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Proyek</th>
                                <th class="text-center">Tanggal Mulai Proyek</th>
                                <th class="text-center">Tanggal Selesai Proyek</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail_events as $item)
                                <tr class="text-nowrap align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->proyek->nama_proyek }}</td>
                                    <td>{{ $item->proyek->tanggal_mulai }}</td>
                                    <td>{{ $item->proyek->tanggal_selesai }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger" data-confirm-delete="true"
                                            onclick="konfirmasiHapus('{{ route('direktur.delete.kalender.proyek', $item->id) }}')">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Acara Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="eventDetails"></p>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahModalLabel">
                        <i class="bi bi-calendar2-plus-fill"></i>
                        Tambah Acara
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('direktur.save.kalender.proyek') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="proyek-id" class="col-form-label">Pilih Proyek</label>
                            <select name="proyek_id" id="proyek-id" class="form-select">
                                @if (count($proyek) > 0)
                                    @foreach ($proyek as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_proyek }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>Data tidak ada</option>
                                @endif
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection




@push('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.10/index.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap5',
                selectable: true,
                slotMinTime: '8:00:00',
                slotMaxTime: '19:00:00',
                events: @json($events),
                eventClick: function(info) {
                    function formatDate(date) {
                        const options = {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        };
                        return new Date(date).toLocaleDateString('id-ID', options);
                    }
                    const description = info.event.extendedProps.description || 'Tidak ada deskripsi.';
                    const eventDetails = 'Nama Proyek:\n' + info.event.title +
                        '\n\nTanggal Mulai:\n' + formatDate(info.event.start) +
                        '\n\nTanggal Selesai:\n ' + formatDate(info.event
                            .end);
                    document.getElementById('eventDetails').innerText = eventDetails;
                    var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                    eventModal.show();
                }
            });
            calendar.render();
            var calendarButton = document.getElementById('calendarButton');

            calendarButton.addEventListener('click', function() {
                toggleCalendarView();
            });

            function toggleCalendarView() {
                var currentView = calendar.view.type;
                var newViewName, newButtonName;
                if (currentView === 'dayGridMonth') {
                    newViewName = 'listWeek';
                    newButtonName = '<i class="bi bi-calendar2-day-fill"></i> List';
                } else {
                    newViewName = 'dayGridMonth';
                    newButtonName = '<i class="bi bi-calendar2-month-fill"></i> Grid';
                }

                calendarButton.innerHTML = newButtonName;
                calendar.changeView(newViewName);
            }
        });





        document.addEventListener('DOMContentLoaded', function() {
            var toggleButton = document.getElementById('toggleButton');
            var kalender = document.getElementById('kalender');
            var tabelacara = document.getElementById('tabelacara');
            var titlename = document.getElementById('name-title');
            toggleButton.addEventListener('click', function() {
                if (kalender.style.display === 'none') {
                    kalender.style.display = 'block';
                    tabelacara.style.display = 'none';
                    toggleButton.innerHTML = '<i class="bi bi-calendar2-event-fill"></i> Edit Acara';
                    titlename.innerHTML = 'Kalender Proyek';
                } else {
                    kalender.style.display = 'none';
                    tabelacara.style.display = 'block';
                    toggleButton.innerHTML = '<i class="bi bi-calendar2-event-fill"></i> Kalender';
                    titlename.innerHTML = 'Tabel Acara Kalender Proyek';
                }
            });
        });
    </script>

    <script>
        function konfirmasiHapus(deleteUrl) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah kamu yakin ingin menghapus ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#435ebe',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = deleteUrl;
                }
            });
        }
    </script>
@endpush
