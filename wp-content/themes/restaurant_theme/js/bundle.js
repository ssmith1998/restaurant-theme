(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
Vue.component('booking-form', {
    template: `
    <div class="wrapper">
    <form v-if="step === 1">
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


<form v-if="step === 2" class="px-4 py-2">
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
  <input type="text" class="form-control" id="fname">
</div>
<div class="col-sm-6 py-3">
  <label for="surname">Surname</label>
  <input type="text" class="form-control" id="surname">
</div>
<div class="col-sm-6 py-3">
<label for="phone">Phone</label>
<input type="tel" class="form-control mb-5" id="phone">
<label for="email">Email address</label>
<input @keyup="bookingFormSubmit"  type="email" class="form-control" id="email" aria-describedby="emailHelp">
</div>
<div class="col-sm-6 py-3">
<label for="requests">Special Requests</label>
<textarea class="w-100 h-100 form-control" id="request"></textarea>
</div>
</div>
<div class="d-flex justify-content-between">
<button @click="prevStep" type="button" class="btn btn-primary">Back</button>
<button @click="onReserve" type="button" class="btn btn-dark">Reserve</button>
</div>
</form>
</div>
    `,
    data() {
        return {
            title: 'Bookings',
            bookingFormStep1: {
                party: '',
                date: '',
                time: [],
            },
            bookingFormStep2: {
                contact_info: {
                    fName: '',
                    lName: '',
                    phone: '',
                    email: '',
                    requests: ''
                }
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
        onReserve() {
            Axios.get('/user?ID=12345')
                .then(function (response) {
                    // handle success
                    console.log(response);
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
},{}]},{},[1]);
