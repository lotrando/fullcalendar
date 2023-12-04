<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>jQuery CALTAB</title>
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="{{ asset('js/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
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
                          <th>Oddělení</th>
                          <th>Od</th>
                          <th>Do</th>
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
                  <label class="form-label">{{ __('Department') }}</label>
                  <select class="form-select" id="department_id" name="department_id">
                    <option value=" " selected>Vyberte oddělení</option>
                    @foreach ($departments as $department)
                      <option value="{{ $department->id }}" @if (old('department_id') == $department->id) selected @endif>
                        {{ $department->department_code }} - {{ $department->department_name }}
                      </option> @endforeach
                  </select>
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
              <input id="action" type="hidden">
              <input id="event_id" name="event_id" type="hidden">
              <input id="user_id" name="user_id" type="hidden">
            </div>
            <div class="modal-footer" class="modal-footer" class="modal-footer" class="modal-footer">
              <button class="btn btn-muted me-auto" data-bs-dismiss="modal" type="button">Zavřít</button>
              <button class="btn btn-danger" id="delete-button">Odstranit</button>
              <button class="btn btn-success" id="submit-button" type="submit"></button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src=" {{ asset('js/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="http://cdn.datatables.net/plug-ins/1.13.7/sorting/czech-string.js"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/locale/cs.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var calendar = $('#calendar').fullCalendar({
        header: {
          left: 'title',
          center: '',
          right: 'today prev,next'
        },
        allDay: true,
        eventOvelap: true,
        weekNumbers: true,
        height: 760,
        editable: true,
        events: "{{ route('events.index') }}",
        selectable: true,
        select: function(start, end, allDay) {
          if (moment().format('Y-M-DD') === start.format('Y-M-DD') || start.isAfter(moment())) {
            $('input, select').attr('readonly', false).prop('disabled', false)
            $('.modal-title').html('Nová rezervace malování')
            $('.modal-header').removeClass('bg-red-lt').addClass('bg-lime-lt')
            $('#createInputForm')[0].reset()
            $('#start').val(start.format())
            $('#end').val(end.format())
            $('#user_id').val(1)
            $('#delete-button').hide()
            $('#submit-button').show().html('Rezervovat')
            $("#createModal").modal("show")
            $('#action').val('Add')
          } else {
            toastr.error("Rezervace nelze vytářet v minulosti");
          }
        },
        eventClick: function(event) {
          $.ajax({
            type: "GET",
            url: "event/" + event.id,
            dataType: "json",
            success: function(html) {
              if (html.warning) {
                toastr.warning(html.warning)
                return
              }
              $('.modal-title').html('Odstranit rezervaci č.' + event.id)
              $('.modal-header').removeClass('bg-lime-lt').addClass('bg-red-lt')
              $('#title').val(html.data.title)
              $('#user_name').val(html.data.user.name)
              $('#start').val(html.data.start)
              $('#end').val(html.data.end)
              $('#event_id').val(event.id)
              $('#department_id').val(html.data.department_id)
              $('#item_id').val(html.data.item_id)
              $('#user_id').val(html.data.user_id)
              $('#delete-button').show()
              $('#submit-button').hide()
              $("#createModal").modal("show")
              $('#action').val('Delete')
            }
          });
        },
        eventDrop: function(event, delta, revertFunc) {
          var start = moment(event.start).format('Y-MM-DD')
          var end = moment(event.end).format('Y-MM-DD')
          $.ajax({
            url: "event/update/" + event.id,
            type: "POST",
            data: {
              title: event.title,
              user_id: event.user_id,
              department_id: event.department_id,
              start: start,
              end: end,
            },
            success: function(response) {
              if (response.errors) {
                calendar.fullCalendar('refetchEvents')
                toastr.error('Rezervace nelze přesouvat do minulosti')
              } else {
                calendar.fullCalendar('refetchEvents')
                myTable.draw()
                toastr.success("Rezervace úspěšně upravena")
              }
            },
          });
        },
        selectOverlap: function(event) {
          if (event.item_id === $('#item_id option:selected').val()) {
            return false;
          }
          return true;
        },
        eventOverlap: function(stillEvent, movingEvent) {
          return stillEvent.department_id !== movingEvent.department_id;
        },
        eventDataTransform: function(event) {
          if (event.user_id == 1) {
            event.editable = true;
          }
          return event;
        },
        eventRender: function(event, element) {
          element.html(event.id + ' - ' + event.title);
          // if (event.status) {
          //   element.popover({
          //     title: event.title + ' : ' + event.user_name,
          //     content: 'Stav: ' + event.status,
          //     trigger: 'hover',
          //     placement: 'top',
          //   });
          // }
        }
      });

      $('#createInputForm').on('submit', function(event) {
        event.preventDefault(event)
        if ($('#action').val() === 'Add') {
          $.ajax({
            url: "{{ route('event.store') }}",
            method: "POST",
            beforeSend: function() {
              $('#submit-button').addClass('btn-loading')
            },
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
              if (data.used) {
                toastr.error("Předmět rezervace je již v tomto termínu rezervován !");
              }
              if (data.errors) {
                $('#submit-button').removeClass('btn-loading')
                for (var count = 0; count < data.errors.length; count++) {
                  toastr.error(data.errors[count])
                }
              }
              if (data.success) {
                setTimeout(function() {
                  $('#createModal').modal('hide')
                  $('#submit-button').removeClass('btn-loading')
                  toastr.success("Rezervace úspěšně uložena")
                }, 1000);
                calendar.fullCalendar('refetchEvents')
                myTable.draw()
              }
            }
          })
        }
      });

      $('#delete-button').on('click', function(event) {
        event.preventDefault(event)
        id = $('#event_id').val()
        $.ajax({
          url: "event/destroy/" + id,
          method: "DELETE",
          beforeSend: function() {
            $('#delete-button').addClass('btn-loading')
          },
          success: function(data) {
            setTimeout(function() {
              $('#delete-button').removeClass('btn-loading')
              $('#createModal').modal('hide')
              toastr.success(data.success)
            }, 2000)
            calendar.fullCalendar('refetchEvents')
            myTable.draw()
          }
        })
      });
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
            data: 'department.department_name',
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
