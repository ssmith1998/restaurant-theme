Vue.component('booking-form', {
    template: `
    <div class="wrapper">
    <form v-if="step === 1 && bookingSuccess === false">
  <div class="row flex-column">
  <h1 class="text-center">{{ title }}</h1>
    <div class="inputWrapper d-flex">
    <div class="col-sm-6">
      <label for="exampleInputEmail1">Party</label>
      <input @keyup="bookingFormSubmit" v-model="bookingFormStep1.party" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
    <div class="col-sm-6">
      <label for="exampleInputEmail1">Date</label>
      <input @keyup="bookingFormSubmit" v-model="bookingFormStep1.date" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
    </div>
  </div>
  <div class="row flex-colmn my-5 border p-4">
    <h6 class="pb-4">Please choose a time below:</h6>
    <div class="row timesWrapper">
    <div class="col-sm-3" v-for="(item, index) in times" :key="index">
    <p @click="timeSelect" :class="bookingFormStep1.time[0] === item ? 'selected' : ''" :data-value="item" class="p-2 border rounded timeItem" >
    {{item}}
    </p>
    </div>
    </div>
  </div>
  <div class="btnWrapper text-right">
  <button :disabled="!bookingFormStep1.time.length > 0 || !bookingFormStep1.date || !bookingFormStep1.party" @click="nextStep" type="button" class="btn btn-dark mx-auto">Confirm</button>
  </div>
</form>


<form v-if="step === 2 && bookingSuccess === false" class="px-4 py-2">
<div class="header d-flex pb-4">
<div class="pr-4">
<h6 style="font-size:30px;">{{ date }}</h6>
<h6>{{ month }}</h6>
</div>
<div class="d-flex flex-column">
<span><strong>Godere</strong></span>
<span><strong>Reservation for {{bookingFormStep1.party}}</strong></span>
<span>{{day}} . {{bookingFormStep1.time[0]}}</span>
</div>
</div>
<div class="row pb-5">
<div class="col-sm-6 py-3">
  <label for="fname">First Name</label>
  <input type="text" class="form-control" id="fname" v-model="bookingFormStep2.fName">
</div>
<div class="col-sm-6 py-3">
  <label for="surname">Surname</label>
  <input type="text" class="form-control" id="surname" v-model="bookingFormStep2.lName">
</div>
<div class="col-sm-6 py-3">
<label for="phone">Phone</label>
<input type="tel" class="form-control mb-5" id="phone" v-model="bookingFormStep2.phone">
<label for="email">Email address</label>
<input @keyup="bookingFormSubmit"  type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="bookingFormStep2.email">
</div>
<div class="col-sm-6 py-3">
<label for="requests">Special Requests</label>
<textarea class="w-100 h-100 form-control" id="request" v-model="bookingFormStep2.requests"></textarea>
</div>
</div>
<div class="d-flex justify-content-between">
<button @click="prevStep" type="button" class="btn btn-primary">Back</button>
<button @click="onReserve" type="button" class="btn btn-dark">Reserve</button>
</div>
</form>

<div v-if="bookingSuccess === true">
<div class="pl-5 pt-3">
<p>You are going to <strong>godere.</strong></p>
<button class="rounded border border-dark bg-white p-2">View Reservation</button>
</div>
<div class="imagesWrapper d-flex pt-4" style="margin:0px -20px 0px -21px">
        <div class="img-wrapper flex-grow-1">
        <img class="w-100 h-100" src="http://api.sorrisopress.gomedia/wp-content/themes/restaurant_theme/assets/images/shawnanggg-nmpW_WwwVSc-unsplash 1.png"/>
        </div>
        <div class="img-wrapper flex-grow-1">
        <img class="w-100 h-100" src="http://api.sorrisopress.gomedia/wp-content/themes/restaurant_theme/assets/images/image 1.png"/>
        </div>
        <div class="img-wrapper flex-grow-1">
        <img class="w-100 h-100" src="http://api.sorrisopress.gomedia/wp-content/themes/restaurant_theme/assets/images/image 2.png"/>
        </div>
</div>
<div class="d-flex justify-content-between px-3">
        <div class="pt-3 d-flex pb-4">
            <div class="pr-4">
                <h6 style="font-size:30px;">{{ date }}</h6>
                <h6>{{ month }}</h6>
            </div>
            <div class="d-flex flex-column">
                <span><strong>Godere</strong></span>
                <p>123 Street Lane</br> 
                North Yorkshire
                </br>
                LS00 BBB</p>
           
            </div>
        </div>

        <div class="btnWrapper d-flex justify-content-around align-items-center">
        <button class="btn btn-dark rounded-circle mx-3 p-3"><i style="font-size:25px;" class="fa fa-phone-square"/></button>
        <button class="btn btn-dark rounded-circle mx-3 p-3"><i style="font-size:25px;"class="fas fa-pencil-alt"/></button>
        <button class="btn btn-dark rounded-circle mx-3 p-3"><i style="font-size:25px;"class="far fa-times-circle"></i></button>
        </div>
</div>
<div class="d-flex justify-content-between px-3 pb-3">
    <div>
        <p class="m-0"><strong>Reservation for {{bookingFormStep1.party}}</strong></p>
        <p class="m-0">{{day}} . {{bookingFormStep1.time[0]}}</p>
        <button class="rounded border border-dark bg-white p-2 mt-2">Get Directions</button>
    </div>
    <div class="d-flex align-items-end">
        <button class=" p-2 mt-2 rounded text-white mr-3" style="background: #211F1F; width:200px;">Done</button>
    </div>
</div>
</div>
    `,
    data() {
        return {
            bookingSuccess: true,
            postId: '',
            bookingConfirmed: null,
            token: '',
            title: 'Bookings',
            bookingFormStep1: {
                party: '',
                date: '',
                time: [],
            },
            bookingFormStep2: {
                fName: '',
                lName: '',
                phone: '',
                email: '',
                requests: ''
            },
            step: 1,
            times: [
                '9AM',
                '10AM',
                '11AM',
                '12AM',
                '1PM',
                '2PM',
                '3PM',
                '4PM',
                '5PM',
                '6PM',
                '7PM',
                '8PM',
                '9PM',
                '10PM',
                '11PM',
                '12PM',

            ],

        }
    },
    methods: {
        //1:get token for auth wordpress
        onReserve() {
            //get token for auth
            axios.post('http://api.sorrisopress.gomedia/wp-json/jwt-auth/v1/token', {
                username: 'admin',
                password: 'admin'
            }).then((response) => {
                console.log(response)
                this.token = response.data.token
                this.onMakeBooking(response.data.token)


            })
        },
        //2: start booking process
        onMakeBooking(token) {
            const headers = {
                'Authorization': `Bearer ${token}`,
            };
            const initalData = {
                title: 'Booking',
            }
            //make booking
            axios.post('http://api.sorrisopress.gomedia/wp-json/wp/v2/bookings', initalData, {
                    headers
                })
                .then((response) => {
                    // handle success
                    console.log(response);
                    this.postId = response.data.id
                    this.onCustomFields()

                })
        },
        // 3:add custom field data to booking
        onCustomFields() {
            const data = {

                "fields": {
                    party: this.bookingFormStep1.party,
                    booking_date: null,
                    booking_time: null,
                    email: this.bookingFormStep2.email,
                    first_name: this.bookingFormStep2.fName,
                    surname: this.bookingFormStep2.lName,
                    phone: this.bookingFormStep2.phone,
                    special_requests: this.bookingFormStep2.requests
                }

            }
            const headers = {
                'Authorization': `Bearer ${this.token}`,
            };
            //edit booking for the custom fields
            axios.post(`http://api.sorrisopress.gomedia/wp-json/acf/v3/bookings/${this.postId}`, data, {
                headers
            }).then((response) => {
                console.log('END', response);
                //retrieve booking
                this.onRetrieveBooking()


            });
        },
        //4:retrieve booking made
        onRetrieveBooking() {
            const headers = {
                'Authorization': `Bearer ${this.token}`,
            };
            axios.get(`http://api.sorrisopress.gomedia/wp-json/wp/v2/bookings/${this.postId}`, {
                    headers
                })
                .then((response) => {
                    // handle success
                    console.log(response);
                    this.bookingConfirmed = response.data
                    this.bookingSuccess = true

                })
        },
        bookingFormSubmit() {
            console.log(this.bookingFormStep1.party);
        },
        nextStep() {
            this.step++;
            localStorage.setItem('bookingFormStep1', JSON.stringify(this.bookingFormStep1));
        },
        prevStep() {
            this.step--;
        },
        timeSelect(evt) {
            this.bookingFormStep1.time = []
            console.log(evt)
            const items = document.querySelectorAll('.timeItem');
            const selectedItem = evt.target
            this.bookingFormStep1.time.push(selectedItem.getAttribute('data-value'))
            console.log(this.bookingFormStep1.time)
            console.log(items);
            items.forEach(item => {
                item.classList.remove('selected')
            })
            selectedItem.classList.add('selected')

        }
    },

    computed: {
        date() {
            let date = new Date(this.bookingFormStep1.date)

            return date.getDate()
        },
        month() {
            let date = new Date(this.bookingFormStep1.date)

            date = date.toLocaleString('default', {
                month: 'short'
            })

            return date.toUpperCase()
        },

        day() {
            let date = new Date(this.bookingFormStep1.date)

            date = date.toLocaleString('default', {
                weekday: 'long'
            })

            return date

        }
    }
})

var app = new Vue({
    el: '#app',
    data: {
        message: 'Hello Vue!',
        title: 'Bookings',
        form: {
            test: ''
        }
    }
})