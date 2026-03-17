


// !function(l){"use strict";function e(){this.$body=l("body"),this.$modal=l("#event-modal"),this.$calendar=l("#calendar"),this.$formEvent=l("#form-event"),this.$btnNewEvent=l("#btn-new-event"),this.$btnDeleteEvent=l("#btn-delete-event"),this.$btnSaveEvent=l("#btn-save-event"),this.$modalTitle=l("#modal-title"),this.$calendarObj=null,this.$selectedEvent=null,this.$newEventData=null}e.prototype.onEventClick=function(e){this.$formEvent[0].reset(),this.$formEvent.removeClass("was-validated"),this.$newEventData=null,this.$btnDeleteEvent.show(),this.$modalTitle.text("Edit Event"),this.$modal.show(),this.$selectedEvent=e.event,l("#event-title").val('Custom'),l("#event-category").val(this.$selectedEvent.classNames[0])},e.prototype.onSelect=function(e){this.$formEvent[0].reset(),this.$formEvent.removeClass("was-validated"),this.$selectedEvent=null,this.$newEventData=e,this.$btnDeleteEvent.hide(),this.$modalTitle.text("Add New Event"),this.$modal.show(),this.$calendarObj.unselect()},e.prototype.init=function(){this.$modal=new bootstrap.Modal(document.getElementById("event-modal"),{keyboard:!1});var e=new Date(l.now());new FullCalendar.Draggable(document.getElementById("external-events"),{itemSelector:".external-event",eventData:function(e){return{title:e.innerText,className:l(e).data("class")}}});var t=[{title:"Meeting with Mr. Shreyu",start:new Date(l.now()+158e6),end:new Date(l.now()+338e6),className:"bg-warning"},{title:"Interview - Backend Engineer",start:e,end:e,className:"bg-success"},{title:"Phone Screen - Frontend Engineer",start:new Date(l.now()+168e6),className:"bg-info"},{title:"Buy Design Assets",start:new Date(l.now()+338e6),end:new Date(l.now()+4056e5),className:"bg-primary"}],a=this;a.$calendarObj=new FullCalendar.Calendar(a.$calendar[0],{slotDuration:"00:15:00",slotMinTime:"08:00:00",slotMaxTime:"19:00:00",themeSystem:"bootstrap",bootstrapFontAwesome:!1,buttonText:{today:"Today",month:"Month",week:"Week",day:"Day",list:"List",prev:"Prev",next:"Next"},initialView:"dayGridMonth",handleWindowResize:!0,height:l(window).height()-200,headerToolbar:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay,listMonth"},initialEvents:t,editable:!0,droppable:!0,selectable:!0,dateClick:function(e){a.onSelect(e)},eventClick:function(e){a.onEventClick(e)}}),a.$calendarObj.render(),a.$btnNewEvent.on("click",function(e){a.onSelect({date:new Date,allDay:!0})}),a.$formEvent.on("submit",function(e){e.preventDefault();var t,n=a.$formEvent[0];n.checkValidity()?(a.$selectedEvent?(a.$selectedEvent.setProp("title",l("#event-title").val()),a.$selectedEvent.setProp("classNames",[l("#event-category").val()])):(t={title:l("#event-title").val(),start:a.$newEventData.date,allDay:a.$newEventData.allDay,className:l("#event-category").val()},a.$calendarObj.addEvent(t)),a.$modal.hide()):(e.stopPropagation(),n.classList.add("was-validated"))}),l(a.$btnDeleteEvent.on("click",function(e){a.$selectedEvent&&(a.$selectedEvent.remove(),a.$selectedEvent=null,a.$modal.hide())}))},l.CalendarApp=new e,l.CalendarApp.Constructor=e}(window.jQuery),function(){"use strict";window.jQuery.CalendarApp.init()}();
// !(function ($) {
//     "use strict";

//     function CalendarApp() {
//         this.$body = $("body");
//         this.$modal = $("#event-modal");
//         this.$calendar = $("#calendar");
//         this.$formEvent = $("#form-event");
//         this.$btnNewEvent = $("#btn-new-event");
//         this.$btnDeleteEvent = $("#btn-delete-event");
//         this.$btnSaveEvent = $("#btn-save-event");
//         this.$btnEditEvent = $("#btn-edit-event");
//         this.$modalTitle = $("#modal-title");

//         this.$calendarObj = null;
//         this.$selectedEvent = null;
//         this.$newEventData = null;
//     }

//     CalendarApp.prototype.onEventClick = function (event) {
//         this.$formEvent[0].reset();
//         this.$formEvent.removeClass("was-validated");
//         this.$newEventData = null;
//         this.$btnDeleteEvent.show();
//         this.$modalTitle.text("Edit Event");
//         this.$modal.show();
//         this.$btnEditEvent.show();
//         this.$btnSaveEvent.hide();        
//         this.$selectedEvent = event.event;
//         $("#event-title").val(this.$selectedEvent.title);
//         $("#event-category").val(this.$selectedEvent.classNames[0]);
//         document.getElementById("event-location").value = this.$selectedEvent.extendedProps.location;
//     };

//     CalendarApp.prototype.onSelect = function (event) {
//         this.$formEvent[0].reset();
//         this.$formEvent.removeClass("was-validated");
//         this.$selectedEvent = null;
//         this.$newEventData = event;
//         this.$btnDeleteEvent.hide();
//         this.$btnEditEvent.hide();
//         this.$btnSaveEvent.show();
//         this.$modalTitle.text("Add New Event");
//         this.$modal.show();
//         this.$calendarObj.unselect();
//     };

//     CalendarApp.prototype.init = function () {
//         this.$modal = new bootstrap.Modal(document.getElementById("event-modal"), { keyboard: false });
//         var currentDate = new Date($.now());

//         new FullCalendar.Draggable(document.getElementById("external-events"), {
//             itemSelector: ".external-event",
//             eventData: function (eventEl) {
//                 return {
//                     title: eventEl.innerText,
//                     className: $(eventEl).data("class")
//                 };
//             }
//         });
       
//         var events = function eventValues()
//             {
//                 return new Promise((resolve) => {
//                     $.ajax({
//                             url: "/admin/getEvents", 
//                             method: "GET",
//                             dataType: "json",
//                             success: function (response) {
//                                 console.log(response);
//                                 resolve(response);
//                                 document.getElementById("event-location").value = selectedEvent.extendedProps.location;
//                             },
//                             error: function (xhr, status, error) {
//                                 console.error("Error fetching events:", xhr.responseText);
//                             }
//                             });
//                 });
                
//             };
        

//         var self = this;
//         this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
//             slotDuration: "00:15:00",
//             slotMinTime: "08:00:00",
//             slotMaxTime: "19:00:00",
//             themeSystem: "bootstrap",
//             bootstrapFontAwesome: false,
//             buttonText: {
//                 today: "Today",
//                 month: "Month",
//                 week: "Week",
//                 day: "Day",
//                 list: "List",
//                 prev: "Prev",
//                 next: "Next"
//             },
//             initialView: "dayGridMonth",
//             handleWindowResize: true,
//             height: $(window).height() - 200,
//             headerToolbar: {
//                 left: "prev,next today",
//                 center: "title",
//                 right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
//             },
//             events: events,
//             editable: true,
//             droppable: true,
//             selectable: true,
//             dateClick: function (info) {
//                 self.onSelect(info);
//             },
//             eventClick: function (info) {
//                 self.onEventClick(info);
//             }, 
//             onSelect: function(info){
//                 console.log(info+"something");
//             }
//         });

//         this.$calendarObj.render();
        
//         this.$btnNewEvent.on("click", function () {
//             self.onSelect({ date: new Date(), allDay: true });
//         });
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//             }
//         });

//         let clickedButtonId = null;

//         $('#btn-save-event, #btn-edit-event').on('click', function () {
//             clickedButtonId = this.id;
//         });
    
//         this.$formEvent.on("submit", function (event) {
//             event.preventDefault();
            
//             var form = self.$formEvent[0];
//             if (form.checkValidity()) {
//                 if (self.$selectedEvent) {

//                     $.ajax({
//                         url: "/admin/updateEvent",
//                         method: "PUT",

//                         data: {
//                             title: self.$selectedEvent.title,
//                             newTitle: $('#event-title').val(),
//                             location: $('#event-location').val(),
//                         },
//                         success: function(response){
//                             self.$selectedEvent.setProp("title", $("#event-title").val());
//                             self.$selectedEvent.setProp("classNames", [$("#event-category").val()]);
//                             self.$selectedEvent.setExtendedProp("location", $("#event-location").val());
//                         }
//                     });
//                 } else {
//                     var title = $("#event-title").val();
//                     var category = $("#event-category").val();
//                     var location = $("#event-location").val();
//                     var start = self.$newEventData.dateStr || new Date().toISOString();
//                     var end = start; // You can enhance this later if you allow choosing end datetime

//                     $.ajax({
//                         url: "/admin/storeEvent",
//                         method: "POST",
                        
//                         data: {
//                             title: title,
//                             category: category,
//                             start: start,
//                             end: end,
//                             location : location,
//                         },
//                         success: function (response) {
//                             // Add to calendar
//                             self.$calendarObj.addEvent({
//                                 title: title,
//                                 start: start,
//                                 end: end,
//                                 className: category,
//                                 location: location
//                             });

//                             $("#success-message").text("✅ " + response.message).removeClass("d-none");
//                             self.$modal.hide();

//                             setTimeout(() => $("#success-message").addClass("d-none"), 5000);
//                         },
//                         error: function (xhr) {
//                             console.error("Save failed:", xhr.responseText);
//                         }
//                     });
//                 }
//                 self.$modal.hide();
//             } else {
//                 event.stopPropagation();
//                 form.classList.add("was-validated");
//             }
//         });

//         $(this.$btnDeleteEvent).on("click", function () {
//             if (self.$selectedEvent) {
//                     $.ajax({
//                         url: "/admin/deleteEvent",
//                         method: "DELETE",
                        
//                         data: {
//                             title: self.$selectedEvent.title,
//                         },
//                         success: function (response) {
//                             self.$selectedEvent.remove();
//                             self.$selectedEvent = null;
//                             self.$modal.hide();
//                         },
//                         error: function (xhr) {
//                             console.error("Save failed:", xhr.responseText);
//                         }
//                     });
//             }
//         });
//     };

//     $.CalendarApp = new CalendarApp();
//     $.CalendarApp.Constructor = CalendarApp;
// })(window.jQuery);

// (function () {
//     "use strict";
//     window.jQuery.CalendarApp.init();
// })();




// !function(l){"use strict";function e(){this.$body=l("body"),this.$modal=l("#event-modal"),this.$calendar=l("#calendar"),this.$formEvent=l("#form-event"),this.$btnNewEvent=l("#btn-new-event"),this.$btnDeleteEvent=l("#btn-delete-event"),this.$btnSaveEvent=l("#btn-save-event"),this.$modalTitle=l("#modal-title"),this.$calendarObj=null,this.$selectedEvent=null,this.$newEventData=null}e.prototype.onEventClick=function(e){this.$formEvent[0].reset(),this.$formEvent.removeClass("was-validated"),this.$newEventData=null,this.$btnDeleteEvent.show(),this.$modalTitle.text("Edit Event"),this.$modal.show(),this.$selectedEvent=e.event,l("#event-title").val('Custom'),l("#event-category").val(this.$selectedEvent.classNames[0])},e.prototype.onSelect=function(e){this.$formEvent[0].reset(),this.$formEvent.removeClass("was-validated"),this.$selectedEvent=null,this.$newEventData=e,this.$btnDeleteEvent.hide(),this.$modalTitle.text("Add New Event"),this.$modal.show(),this.$calendarObj.unselect()},e.prototype.init=function(){this.$modal=new bootstrap.Modal(document.getElementById("event-modal"),{keyboard:!1});var e=new Date(l.now());new FullCalendar.Draggable(document.getElementById("external-events"),{itemSelector:".external-event",eventData:function(e){return{title:e.innerText,className:l(e).data("class")}}});var t=[{title:"Meeting with Mr. Shreyu",start:new Date(l.now()+158e6),end:new Date(l.now()+338e6),className:"bg-warning"},{title:"Interview - Backend Engineer",start:e,end:e,className:"bg-success"},{title:"Phone Screen - Frontend Engineer",start:new Date(l.now()+168e6),className:"bg-info"},{title:"Buy Design Assets",start:new Date(l.now()+338e6),end:new Date(l.now()+4056e5),className:"bg-primary"}],a=this;a.$calendarObj=new FullCalendar.Calendar(a.$calendar[0],{slotDuration:"00:15:00",slotMinTime:"08:00:00",slotMaxTime:"19:00:00",themeSystem:"bootstrap",bootstrapFontAwesome:!1,buttonText:{today:"Today",month:"Month",week:"Week",day:"Day",list:"List",prev:"Prev",next:"Next"},initialView:"dayGridMonth",handleWindowResize:!0,height:l(window).height()-200,headerToolbar:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay,listMonth"},initialEvents:t,editable:!0,droppable:!0,selectable:!0,dateClick:function(e){a.onSelect(e)},eventClick:function(e){a.onEventClick(e)}}),a.$calendarObj.render(),a.$btnNewEvent.on("click",function(e){a.onSelect({date:new Date,allDay:!0})}),a.$formEvent.on("submit",function(e){e.preventDefault();var t,n=a.$formEvent[0];n.checkValidity()?(a.$selectedEvent?(a.$selectedEvent.setProp("title",l("#event-title").val()),a.$selectedEvent.setProp("classNames",[l("#event-category").val()])):(t={title:l("#event-title").val(),start:a.$newEventData.date,allDay:a.$newEventData.allDay,className:l("#event-category").val()},a.$calendarObj.addEvent(t)),a.$modal.hide()):(e.stopPropagation(),n.classList.add("was-validated"))}),l(a.$btnDeleteEvent.on("click",function(e){a.$selectedEvent&&(a.$selectedEvent.remove(),a.$selectedEvent=null,a.$modal.hide())}))},l.CalendarApp=new e,l.CalendarApp.Constructor=e}(window.jQuery),function(){"use strict";window.jQuery.CalendarApp.init()}();

!(function ($) {
    "use strict";

    function CalendarApp() {
        this.$body = $("body");
        this.$modal = $("#event-modal");
        this.$calendar = $("#calendar");
        this.$formEvent = $("#form-event");
        this.$btnNewEvent = $("#btn-new-event");
        this.$btnDeleteEvent = $("#btn-delete-event");
        this.$btnSaveEvent = $("#btn-save-event");
        this.$btnEditEvent = $("#btn-edit-event");
        this.$modalTitle = $("#modal-title");

        this.$calendarObj = null;
        this.$selectedEvent = null;
        this.$newEventData = null;
    }

    CalendarApp.prototype.onEventClick = function (event) {
        
        this.$formEvent[0].reset();
        this.$formEvent.removeClass("was-validated");
        this.$newEventData = null;
        this.$btnDeleteEvent.show();
        this.$modalTitle.text("Edit Vehicle");
        this.$modal.show();
        this.$btnEditEvent.show();
        this.$btnSaveEvent.hide();        
        this.$selectedEvent = event.event;
        // $("#event-title").val(this.$selectedEvent.title);
        
        $("#lisence_plate").val(this.$selectedEvent.title);
        $("#event-category").val(this.$selectedEvent.classNames[0]);
        
        // let thumbnail = this.$selectedEvent.extendedProps.thumbnail;
        // if (typeof thumbnail !== "string") {
        //       thumbnail = event.event.extendedProps.thumbnail;
        //       console.log(thumbnail)
        // }
        
        // if (thumbnail) {
        //     $("#uploadThumbnailPreview").attr("src", '/storage/' + thumbnail);
        // }
        $("#ThumbnailPreview").empty();
        const SelectedThumbnail = this.$selectedEvent.extendedProps.thumbnail;
        const thumb = $("<img>").attr("src", "/storage/" + SelectedThumbnail).addClass("thumbnail").css({ width: "120px", margin: "5px" });
        $("#ThumbnailPreview").append(thumb);

        $("#currentImagePreview").empty();
        const images = this.$selectedEvent.extendedProps.images;
        if (Array.isArray(images)) {
            images.forEach(image => {
                const img = $("<img>")
                .attr("src", "/storage/" + image)
                .css({
                    width: "120px",
                    height: "120px",
                    borderRadius: "8px",
                    margin: "5px",
                    boxShadow: "0 2px 5px rgba(0, 0, 0, 0.2)"
                });

                $("#currentImagePreview").append(img);
            });
        }


        const props = [
            "vehicle_id", "model", "category", "city", "location",
            "fuel_type", "transmission", "drive", "weight", "doors",
            "year", "engine_size", "luggage", "seats", "fuel_economy",
            "exterior_color", "interior_color", "rent", "mileage",
            "detail", "status", "date_added", "features",
        ];

        props.forEach(prop => {
        const el = document.getElementById(prop);
        const value = this.$selectedEvent.extendedProps[prop] ?? "";

        if (prop === "features") {
            const features = Array.isArray(value) ? value : [];
            document.querySelectorAll("input[name='features[]']").forEach((checkbox) => {
                checkbox.checked = features.includes(checkbox.value);
            });
            return;
        }

        if (el) {
            el.value = value;
        }
        
    });


        loadArea(
            this.$selectedEvent.extendedProps.city,
            this.$selectedEvent.extendedProps.location
        );
    };

    CalendarApp.prototype.onSelect = function (event) {
        
        this.$formEvent[0].reset();
        this.$formEvent.removeClass("was-validated");
        this.$selectedEvent = null;
        this.$newEventData = event;
        $("#currentImagePreview").html('');
        $("#ThumbnailPreview").html('');

        // Manually clear location dropdown and disable it
        $('#location').html('<option disabled selected>Select</option>').prop('disabled', true);

        // // Reset file inputs
        // $('#thumbnail').val('');
        // $('#images').val('');

        // // Clear preview images
        //$('#uploadThumbnailPreview').removeAttr('src');
        // // Clear uploaded image previews
        // $('#uploadImagePreview').empty().hide();

        // // Clear existing (preloaded) image previews, if any
        // $('#currentImagePreview').empty().hide();


        // // Clear selected features
        // $("input[name='features[]']").prop('checked', false);

        // // Clear hidden ID field
        // $('#vehicle_id').val('');

        this.$btnDeleteEvent.hide();
        this.$btnEditEvent.hide();
        this.$btnSaveEvent.show();
        this.$modalTitle.text("Create Vehicle");
        this.$modal.show();
        this.$calendarObj.unselect();
    };


    CalendarApp.prototype.init = function () {
        this.$modal = new bootstrap.Modal(document.getElementById("event-modal"), { keyboard: false });
        var currentDate = new Date($.now());

        new FullCalendar.Draggable(document.getElementById("external-events"), {
            itemSelector: ".external-event",
            eventData: function (eventEl) {
                return {
                    title: eventEl.innerText,
                    className: $(eventEl).data("class")
                };
            }
        });
       
        var vehicles= function vehicleDetails()
            {
                return new Promise((resolve) => {
                    $.ajax({
                            url: window.baseUrl+ '/getVehicles', 
                            method: "GET",
                            dataType: "json",
                            success: function (response) {
                                
                            console.log(response);
                            resolve(response);
                            
                            //document.getElementById("uploadThumbnailPreview").src = "/storage/" + selectedEvent.extendedProps.thumbnail;
                            $("#ThumbnailPreview").empty();
                            const thumb = $("<img>").attr("src", "/storage/" + selectedEvent.extendedProps.thumbnail);
                            $("#ThumbnailPreview").append(thumb);

                            $("#currentImagePreview").empty();
                            const images = selectedEvent.extendedProps.images;
                            if (Array.isArray(images)) {
                                images.forEach(image => {
                                    const img = $("<img>")
                                        .attr("src", "/storage/" + image)
                                        .addClass("image") // optional class
                                        .css({ width: "100px", margin: "5px" }); // optional styling
                                    $("#currentImagePreview").append(img);
                                });
                            }

                            const fields = [
                                "model", "vehicle_id", "category", "city", "location",
                                "fuel_type", "transmission", "drive", "weight", "doors",
                                "year", "engine_size", "luggage", "seats", "fuel_economy",
                                "exterior_color", "interior_color", "lisence_plate", "rent",
                                "mileage", "detail", "status", "date_added",
                            ];
                            fields.forEach(field => {
                                // const value = this.$selectedEvent.getExtendedProp(field);
                                const value = selectedEvent.extendedProps.field;
                                const element = document.getElementById(field);
                                if (element) element.value = value ?? "";
                            });
                            let features = selectedEvent.extendedProps.features;
                            features.forEach(feature => {
                                let checkbox = document.querySelector(`input[type="checkbox"][value="${feature}"]`);
                                if (checkbox) {
                                    checkbox.checked = true;
                                }
                            });
                                    
                        },
                        error: function (xhr, status, error) {
                            console.error("Error fetching events:", xhr.responseText);
                        }
                    });
                });
            };
                                    

        var self = this;
        this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {

            eventDrop: function(info) {
                const event = info.event;

                $.ajax({
                    url: window.baseUrl+'/updateEventDate', 
                    method: 'POST',
                    data: {
                        vehicle_id: event.extendedProps.vehicle_id, 
                        new_start: event.start.toISOString(), 
                    },
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Date updated successfully');
                        } else {
                            alert('Update failed: ' + response.message);
                            info.revert(); 
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Error updating date');
                        info.revert(); // Revert drag on error
                    }
                });
            },


            slotDuration: "00:15:00",
            slotMinTime: "08:00:00",
            slotMaxTime: "19:00:00",
            themeSystem: "bootstrap",
            bootstrapFontAwesome: false,
            buttonText: {
                today: "Today",
                month: "Month",
                week: "Week",
                day: "Day",
                list: "List",
                prev: "Prev",
                next: "Next"
            },
            initialView: "dayGridMonth",
            handleWindowResize: true,
            height: $(window).height() - 200,
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,listMonth"
                //right: "dayGridMonth,listMonth"
            },
            events: vehicles,
            editable: true,
            droppable: true,
            selectable: true,
            dateClick: function (info) {
                self.onSelect(info);
            },
            eventClick: function (info) {
                self.onEventClick(info);
            }, 
            onSelect: function(info){
                console.log(info+"something");
            }
        });

        this.$calendarObj.render();
        
        this.$btnNewEvent.on("click", function () {
            self.onSelect({ date: new Date(), allDay: true });
        });
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //     }
        // });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        let clickedButtonId = null;

        $('#btn-save-event, #btn-edit-event').on('click', function () {
            clickedButtonId = this.id;
        });
    
        this.$formEvent.on("submit", function (event) {
            event.preventDefault();
            $("#error-message").addClass("d-none");
            var form = self.$formEvent[0];
            if (form.checkValidity()) {
                if (self.$selectedEvent) {

                    const formData = new FormData();

                    formData.append('_method', 'PUT');

                    const thumbnailInput = document.getElementById("thumbnail");
                    const thumbnailProp = thumbnailInput.files[0];
                    if (thumbnailInput.files.length > 0) {
                        formData.append("thumbnail", thumbnailInput.files[0]);
                    }

                    const imageInput = document.getElementById("images");
                    for (let i = 0; i < imageInput.files.length; i++) {
                        formData.append("images[]", imageInput.files[i]);
                    }

                    formData.append('lisence_plate', $('#lisence_plate').val());
                    formData.append('vehicle_id', $('#vehicle_id').val());
                    formData.append('car_model_id', $('#model').val());
                    formData.append('car_category_id', $('#category').val());
                    formData.append('city', $('#city').val());
                    formData.append('car_location_id', $('#location').val());
                    formData.append('fuel_type', $('#fuel_type').val());
                    formData.append('transmission', $('#transmission').val());
                    formData.append('drive', $('#drive').val());
                    formData.append('weight', $('#weight').val());
                    formData.append('doors', $('#doors').val());
                    formData.append('year', $('#year').val());
                    formData.append('engine_size', $('#engine_size').val());
                    formData.append('luggage', $('#luggage').val());
                    formData.append('seats', $('#seats').val());
                    formData.append('fuel_economy', $('#fuel_economy').val());
                    formData.append('exterior_color', $('#exterior_color').val());
                    formData.append('interior_color', $('#interior_color').val());
                    formData.append('rent', $('#rent').val());
                    formData.append('mileage', $('#mileage').val());
                    formData.append('detail', $('#detail').val());
                    formData.append('status', $('#status').val());

                    $("input[name='features[]']:checked").each(function () {
                        formData.append("features[]", $(this).val());
                    });

                    $.ajax({
                        headers: {
                            'Accept': 'application/json'
                        },
                        url: window.baseUrl+"/updateVehicle",
                        method: "POST", 
                        data: formData,
                        processData: false, 
                        contentType: false, 
                        success: function(response){
                            if(response.status == 'error'){
                                let errorMessage = '';

                                if (response.errors) {
                                    $.each(response.errors, function(key, value) {
                                        errorMessage += '<div>' + value[0] + '</div>';
                                    });
                                } else {
                                    errorMessage = response.message;
                                }

                                $("#error-message")
                                .html(errorMessage)
                                .removeClass("d-none")
                                .show();
                                self.$modal.show();
                            }

                            if(response.status === 'success'){
                                location.reload();
                                var thumbNewPath = response.thumbnailProp;
                                console.log(thumbNewPath)+here;
                                if (thumbnailInput.files.length > 0){
                                    self.$selectedEvent.setExtendedProp("thumbnail", thumbNewPath);
                                }
                                //self.$selectedEvent.setExtendedProp("location", $("#event-location").val());
                                self.$selectedEvent.setProp("title", $('#lisence_plate').val());

                                // $("#ThumbnailPreview").empty();
                                // const thumb = $("<img>").attr("src", "/storage/" + selectedEvent.extendedProps.thumbnail);
                                // $("#ThumbnailPreview").append(thumb);

                                // $("#currentImagePreview").empty();
                                // const images = selectedEvent.extendedProps.images;
                                // if (Array.isArray(images)) {
                                //     images.forEach(image => {
                                //         const img = $("<img>")
                                //             .attr("src", "/storage/" + image)
                                //             .addClass("image") // optional class
                                //             .css({ width: "100px", margin: "5px" }); // optional styling
                                //         $("#currentImagePreview").append(img);
                                //     });
                                // }
                                
                                if(imageInput.files.length > 0){
                                    self.$selectedEvent.setExtendedProp("images", imageInput);
                                }
                                // Correctly update all extendedProps
                                const props = [
                                    "model", "category", "city", "location", "fuel_type", "transmission",
                                    "drive", "weight", "doors", "year", "engine_size", "luggage", "seats",
                                    "fuel_economy", "exterior_color", "interior_color", "lisence_plate",
                                    "rent", "mileage", "detail", "status", 
                                ];

                                props.forEach(prop => {
                                    self.$selectedEvent.setExtendedProp(prop, $("#" + prop).val());
                                });

                                
                                // const thumbnail = this.$selectedEvent.extendedProps.thumbnail;
                                // if (thumbnail) {
                                //     $("#uploadThumbnailPreview").attr("src", '/storage/' + thumbnail);
                                // }

                                self.$selectedEvent.setExtendedProp("features", selectedFeatures);
                                alert(response.message);
                                self.$modal.hide();
                            }else {
                                console.error("Server responded with failure:", response.message);
                            }
                        },
                        error: function (xhr) {
                            console.error("Save failed:", xhr.responseText);
                        }
                    });
                } else {

                    var start = self.$newEventData.dateStr || new Date().toISOString();
                    
                    // const selectedFeatures = [];
                    // $("input[name='features[]']:checked").each(function () {
                    //     selectedFeatures.push($(this).val());
                    // });

                    const formData = new FormData();
                    formData.append('start', start)
                    const thumbnailInput = document.getElementById("thumbnail");
                    const thumbnailProp = thumbnailInput.files[0];
                    if (thumbnailInput.files.length > 0) {
                        formData.append("thumbnail", thumbnailInput.files[0]);
                    }

                    const imageInput = document.getElementById("images");
                    for (let i = 0; i < imageInput.files.length; i++) {
                        formData.append("images[]", imageInput.files[i]);
                    }

                    formData.append('lisence_plate', $('#lisence_plate').val());
                    formData.append('vehicle_id', $('#vehicle_id').val());
                    formData.append('car_model_id', $('#model').val());
                    formData.append('car_category_id', $('#category').val());
                    formData.append('city', $('#city').val());
                    formData.append('car_location_id', $('#location').val());
                    formData.append('fuel_type', $('#fuel_type').val());
                    formData.append('transmission', $('#transmission').val());
                    formData.append('drive', $('#drive').val());
                    formData.append('weight', $('#weight').val());
                    formData.append('doors', $('#doors').val());
                    formData.append('year', $('#year').val());
                    formData.append('engine_size', $('#engine_size').val());
                    formData.append('luggage', $('#luggage').val());
                    formData.append('seats', $('#seats').val());
                    formData.append('fuel_economy', $('#fuel_economy').val());
                    formData.append('exterior_color', $('#exterior_color').val());
                    formData.append('interior_color', $('#interior_color').val());
                    formData.append('rent', $('#rent').val());
                    formData.append('mileage', $('#mileage').val());
                    formData.append('detail', $('#detail').val());
                    formData.append('status', $('#status').val());

                    $("input[name='features[]']:checked").each(function () {
                        formData.append("features[]", $(this).val());
                    });

                    $.ajax({
                        headers: {
                            'Accept': 'application/json'
                        },
                        url: window.baseUrl+ "/storeVehicle",
                        method: "POST", 
                        data: formData,
                        processData: false, 
                        contentType: false, 

                    // $.ajax({
                    //     url: "/admin/storeVehicle",
                    //     method: "POST",
                        
                    //     data: {
                    //         lisence_plate: $("#lisence_plate").val(),
                    //         start: start,
                    //         car_model_id: $('#model').val(),
                    //         car_category_id : $('#category').val(),
                    //         car_location_id: $('#location').val(),
                    //         city: $('#city').val(),
                    //         fuel_type: $('#fuel_type').val(),
                    //         transmission: $('#transmission').val(),
                    //         drive: $('#drive').val(),
                    //         weight: $('#weight').val(),
                    //         doors: $('#doors').val(),
                    //         year: $('#year').val(),
                    //         engine_size: $('#engine_size').val(),
                    //         luggage: $('#luggage').val(),
                    //         seats: $('#seats').val(),
                    //         fuel_economy: $('#fuel_economy').val(),
                    //         exterior_color: $('#exterior_color').val(),
                    //         interior_color: $('#interior_color').val(),
                    //         rent: $('#rent').val(),
                    //         mileage: $('#mileage').val(),
                    //         detail: $('#detail').val(),
                    //         status: $('#status').val(),
                    //         features: selectedFeatures,
                    //     },
                        success: function (response) {

                            if(response.status == 'error'){
                                let errorMessage = '';

                                if (response.errors) {
                                    $.each(response.errors, function(key, value) {
                                        errorMessage += '<div>' + value[0] + '</div>';
                                    });
                                } else {
                                    errorMessage = response.message;
                                }

                                $("#error-message")
                                .html(errorMessage)
                                .removeClass("d-none")
                                .show();
                                self.$modal.show();
                            }
                            
                            if(response.status == 'success'){
                                var start = self.$newEventData.dateStr || new Date().toISOString();
                                var end = start;
                                var title = response['licensePlate'];
                                var className = 'bg-success';
                                // // Add to calendar
                                // self.$calendarObj.addEvent({
                                //     title: title,
                                //     start: start,
                                //     end: end,
                                //     className: className,
                                //     extendedProps: {
                                //         lisence_plate: $("#lisence_plate").val(),
                                //         model: $("#model").val(),
                                //         category: $("#category").val(),
                                //         location: $("#location").val(),
                                //         city: response['city'],
                                //         fuel_type: $("#fuel_type").val(),
                                //         transmission: $("#transmission").val(),
                                //         drive: $("#drive").val(),
                                //         weight: $("#weight").val(),
                                //         doors: $("#doors").val(),
                                //         year: $("#year").val(),
                                //         engine_size: $("#engine_size").val(),
                                //         luggage: $("#luggage").val(),
                                //         seats: $("#seats").val(),
                                //         fuel_economy: $("#fuel_economy").val(),
                                //         exterior_color: $("#exterior_color").val(),
                                //         interior_color: $("#interior_color").val(),
                                //         rent: $("#rent").val(),
                                //         mileage: $("#mileage").val(),
                                //         detail: $("#detail").val(),
                                //         status: $("#status").val(),
                                //     },
                                // });
                                
                                alert(response.message);
                                self.$modal.hide();
                                self.$calendarObj.refetchEvents();
                            }
                        },
                        error: function (xhr) {
                            console.error("Save failed:", xhr.responseText);
                        }
                    });
                }
                self.$modal.hide();
                
            } else {
                event.stopPropagation();
                form.classList.add("was-validated");
            }
        });

        $(this.$btnDeleteEvent).on("click", function () {
            if (self.$selectedEvent) {
                    $.ajax({
                        url: window.baseUrl+ "/deleteVehicle",
                        method: "DELETE",
                        
                        data: {
                            vehicle_id: $('#vehicle_id').val(),
                        },
                        success: function (response) {
                            
                            self.$selectedEvent.remove();
                            self.$selectedEvent = null;
                            self.$modal.hide();
                            alert(response.message);
                        },
                        error: function (xhr) {
                            console.error("Save failed:", xhr.responseText);
                        }
                    });
            }
        });
    };

    function loadArea(city_id, selected_location_id = null){
    if (city_id) {
        $.ajax({
            url: window.getLocationsUrl + '/' + city_id, 
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const $locationSelect = $('select[name="location"]');
                $locationSelect.prop('disabled', false);
                $locationSelect.empty();

                $locationSelect.append('<option value="" selected>Select Area</option>');

                $.each(data, function(key, value) {
                    const selected = selected_location_id == value.id ? 'selected' : '';
                    $locationSelect.append('<option value="' + value.id + '" ' + selected + '>' + value.area_name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    } else {
        const $locationSelect = $('select[name="location"]');
        $locationSelect.prop('disabled', true).empty();
        $locationSelect.append('<option value="" selected>Select Area</option>');
    }
}


    $.CalendarApp = new CalendarApp();
    $.CalendarApp.Constructor = CalendarApp;
})(window.jQuery);

(function () {
    "use strict";
    window.jQuery.CalendarApp.init();
})();

$(document).ready(function () {
    // When either close button is clicked
    $('#event-modal').on('hidden.bs.modal', function () {
        $("#error-message").addClass("d-none");
        if ($("#images")[0].files.length > 0) {
            location.reload();
        }

    });
});




