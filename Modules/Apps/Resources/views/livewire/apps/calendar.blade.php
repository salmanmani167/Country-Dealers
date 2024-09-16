<div>
    <x-modals.modal>
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Event
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="form-group">
                <x-form.wire.input name="name" label="Event Name"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input type="date" name="event_date" label="Event Date"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.select name="category" label="Category">
                    <option>Danger</option>
                    <option>Success</option>
                    <option>Purple</option>
                    <option>Primary</option>
                    <option>Pink</option>
                    <option>Info</option>
                    <option>Inverse</option>
                    <option>Orange</option>
                    <option>Brown</option>
                    <option>Teal</option>
                    <option>Warning</option>
                </x-form.wire.select>
            </div>

            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Event <b>{{$name}}</b></h3>
            <p>Are you sure want to delete?</p>
        </div>
        <form wire:submit.prevent="delete">
            <div class="modal-btn delete-action">
                <div class="row">
                    <div class="col-6">
                        <button type="submit"  class="btn btn-primary w-100 continue-btn">Delete</button>
                    </div>
                    <div class="col-6">
                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
        @else
        <x-slot:title>
            Add Event
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="form-group">
                <x-form.wire.input name="name" label="Event Name"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input type="date" name="event_date" label="Event Date"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.select name="category" label="Category">
                    <option>Danger</option>
                    <option>Success</option>
                    <option>Purple</option>
                    <option>Primary</option>
                    <option>Pink</option>
                    <option>Info</option>
                    <option>Inverse</option>
                    <option>Orange</option>
                    <option>Brown</option>
                    <option>Teal</option>
                    <option>Warning</option>
                </x-form.wire.select>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>
</div>

@push('page-scripts')
<!-- Calendar JS -->
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>
<script>
    $(document).ready(function(){
        var JSONArray =  ("{{$events}}");
        const parser = new DOMParser();
        const decodedJSONString = parser.parseFromString(`<!doctype html><body>${JSONArray}`, 'text/html').body.textContent;
        const jsonEvents = JSON.parse(decodedJSONString);
        const events = jsonEvents.map(item => {
            const eventDate = new Date(item.date_);

            return {
                id: item.id,
                title: item.name,
                start: eventDate,
                className: 'bg-'+(item.category).toLowerCase()
            };
        });
        var CalendarApp = function() {
            this.$calendar = $('#calendar'),
            this.$calendarObj = null
        };
        CalendarApp.prototype.onDrop = function (eventObj, date) {
            var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
        }
        CalendarApp.prototype.enableDrag = function() {
            //init events
            $(this.$event).each(function () {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
            });
        }
        /* Initializing */
        CalendarApp.prototype.init = function() {
            this.enableDrag();
            /*  Initialize the calendar  */
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var form = '';
            var today = new Date($.now());


            var $this = this;
            $this.$calendarObj = $this.$calendar.fullCalendar({
                slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
                minTime: '08:00:00',
                maxTime: '19:00:00',
                defaultView: 'month',
                handleWindowResize: true,
                height: $(window).height() - 200,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: events,
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                drop: function(date) { $this.onDrop($(this), date); },
                // select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
                eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); },
                dayClick: function(date, jsEvent, view) {
                    var year = (date._d).getFullYear();
                    var month = ((date._d).getMonth() + 1).toString().padStart(2, "0");
                    var day = (date._d).getDate().toString().padStart(2, "0");

                    var formattedDate = year + "-" + month + "-" + day;;
                    Livewire.emit('openModal')
                    $('#id_name').val(formattedDate)
                },
            });


        },
        CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
            Livewire.emit(`openModal`, {'model': (calEvent.id)})
        },
        CalendarApp.prototype.onSelect = function (start, end, allDay) {
            var $this = this;
            $this.$calendarObj.fullCalendar('unselect');
        }

        //init CalendarApp
        $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
        $.CalendarApp.init()
    })
</script>
@endpush
