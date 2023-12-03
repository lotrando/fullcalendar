<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Calendar</title>
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="css/tabler.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <style>
      /* #calendar td.fc-day-sun,
      #calendar td.fc-day-sat {
        background-color: #e3e7eb;
      } */
    </style>
  </head>

  <body>
    <div class="page-wrapper">
      <div class="container-fluid">
        <div class="row row-card mt-3">
          <div class="col-12">
            <div class="row row-card g-2">
              <div class="col-12 col-md-6">
                <div class="card shadow-sm">
                  <div class="card-body p-2">
                    <div id="calendar"></div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="card shadow-sm">
                  <div class="card-body p-2">
                    <div class="input-icon">
                      <input class="form-control mb-1" id="mySearchField" type="text" placeholder="Hledej ...">
                      <span class="input-icon-addon">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                          stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                          <path d="M21 21l-6 -6"></path>
                        </svg>
                      </span>
                    </div>
                    <table class="table-hover table rounded" id="datatable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>title</th>
                          <th>user</th>
                          <th>from</th>
                          <th>to</th>
                          <th>
                            <span>
                              <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                              </svg>
                            </span>
                          </th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- createModal --}}
    <div class="modal modal-blur fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false"
      aria-hidden="true" tabindex="-1" style="display: none;">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <form id="createInputForm">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row mb-2">
                <div class="col-6">
                  <label class="form-label">{{ __('Title') }}</label>
                  <input class="form-control" id="title" name="title" type="text">
                </div>
                <div class="col-6">
                  <label class="form-label">{{ __('User name') }}</label>
                  <input class="form-control" id="user-name" name="user-name" type="text">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-6">
                  <label class="form-label">{{ __('Start') }}</label>
                  <input class="form-control" id="start" name="start" type="date">
                </div>
                <div class="col-6">
                  <label class="form-label">{{ __('End') }}</label>
                  <input class="form-control" id="end" name="end" type="date">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-3">
                  <label class="form-label">{{ __('Color') }}</label>
                  <input class="form-control" id="color" name="color" type="text">
                </div>
                <div class="col-3">
                  <label class="form-label">{{ __('Background Color') }}</label>
                  <input class="form-control" id="background-color" name="backgroundColor" type="text">
                </div>
                <div class="col-3">
                  <label class="form-label">{{ __('Border Color') }}</label>
                  <input class="form-control" id="border-color" name="borderColor" type="text">
                </div>
                <div class="col-3">
                  <label class="form-label">{{ __('Text Color') }}</label>
                  <input class="form-control" id="text-color" name="textColor" type="text">
                </div>
              </div>
              <input id="action" type="hidden">
              <input id="event_id" name="event_od" type="hidden">
              <input id="user_id" name="user_id" type="hidden">
            </div>
            <div class="modal-footer" class="modal-footer" class="modal-footer" class="modal-footer">
              <button class="btn btn-muted me-auto" data-bs-dismiss="modal" type="button">Zavřít</button>
              <button class="btn btn-success" id="submit-button" type="submit"></button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="http://cdn.datatables.net/plug-ins/1.13.7/sorting/czech-string.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
          events: "{{ route('events.index') }}",
          initialDate: '2023-12-01',
          initialView: 'dayGridMonth',
          weekNumbers: true,
          weekText: 'T',
          headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next',
          },
          buttonText: {
            today: 'Dnes',
            month: 'Měsíc',
            week: 'Týden',
            day: 'Den',
            list: 'Seznam'
          },
          selectable: true,
          editable: true,
          eventResizableFromStart: true,
          timeZone: 'Europe/Prague',
          locale: 'cs',
          firstDay: 1,
          height: 758,
          eventClick: function(info) {
            var id = info.event.id
            $.ajax({
              type: "POST",
              url: "event/" + id,
              data: {
                id: id
              },
              dataType: "json",
              success: function(html) {
                if (html.warning) {
                  toastr.warning(html.warning);
                  return
                }
                $('.modal-title').html('Upravit')
                $('.modal-header').removeClass('bg-lime-lt').addClass('bg-yellow-lt')
                $('#submit-button').html('Upravit')
                $('#title').val(html.data.title)
                $('#user-name').val(html.data.user.name)
                $('#color').val(html.data.color)
                $('#background-color').val(html.data.background_color)
                $('#border-color').val(html.data.border_color)
                $('#text-color').val(html.data.text_color)
                $('#start').val(html.data.start)
                $('#end').val(html.data.end)
                $('#event-id').val(html.data.id)
                $('#user-id').val(html.data.user_id)
                $("#createModal").modal("show")
              }
            })
          },
          // dateClick: function(info) {
          //   $('.modal-title #submit-button').html('Vložit')
          //   $('.modal-header').removeClass('bg-yellow-lt').addClass('bg-lime-lt')
          //   $('#submit-button').html('Upravit')
          //   $('#title').val('')
          //   $('#start').val(info.endStr)
          //   $('#end').val(info.endStr)
          //   $('#user-id').val(1)
          //   $("#createModal").modal("show")
          // },
          select: function(info) {
            if (moment().format('Y-M-DD') <= info.startStr) {
              $('.modal-title, #submit-button').html('Vložit')
              $('.modal-header').removeClass('bg-yellow-lt').addClass('bg-lime-lt')
              $('#title').val('')
              $('#start').val(info.startStr)
              $('#end').val(info.endStr)
              $("#createModal").modal("show")
            } else {
              toastr.error("Rezervace nelze vytářet v minulosti");
            }
          },
          selectOverlap: function(event) {
            if (event.item_id === $('#item_id option:selected').val()) {
              return false;
            }
            return true;
          }
        });
        calendar.render()
      })
    </script>
    <script>
      var myTable = new DataTable('#datatable', {
        dom: 'lrt',
        paging: false,
        serverSide: true,
        processing: true,
        stateSave: true,
        pageSave: true,
        pageLength: -1,
        lengthChange: false,
        responsive: true,
        fixedHeader: true,
        scrollY: 676,
        deferRender: true,
        searchHighlight: true,
        scroller: false,
        order: [
          [2, "asc"]
        ],
        ajax: {
          type: "GET",
          url: "{{ route('table.index') }}",
          data: {
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          contentType: 'application/json; charset=utf-8',
          data: function(data) {
            console.log(data);
          },
          complete: function(response) {
            console.log(response);
          }
        },
        columns: [{
            data: 'id',
            width: 'auto'
          },
          {
            data: 'title',
            width: 'auto'
          },
          {
            data: 'user.name',
            width: 'auto'
          },
          {
            data: 'start',
            "width": "auto",
            render: function(data, type, full, meta) {
              var date = moment(data).locale('cs');
              return date.format('DD. MM. YYYY');
            }
          },
          {
            data: 'end',
            "width": "auto",
            render: function(data, type, full, meta) {
              var date = moment(data).locale('cs');
              return date.format('DD. MM. YYYY');
            }
          },
          {
            data: 'action',
            "width": "0.5%",
            orderable: false,
            searchable: false
          },
        ]
      })

      $('#mySearchField').keyup(function() {
        myTable.search($(this).val()).draw();
      })
    </script>
  </body>

</html>
