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
<div class="row pb-4">
<div class="col-sm-6">
  <label for="exampleInputEmail1">Email address</label>
  <input @keyup="bookingFormSubmit"  type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
</div>
<div class="col-sm-6">
  <label for="exampleInputPassword1">Password</label>
  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
</div>
<div class="col-sm-6">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
</div>
<div class="col-sm-6">
<label for="exampleInputPassword1">Password</label>
<textarea class="w-100 h-100 form-control"></textarea>
</div>
</div>
<button @click="prevStep" type="button" class="btn btn-primary">Back</button>
<button @click="nextStep" type="button" class="btn btn-primary">Next</button>
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