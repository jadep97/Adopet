// Animations initialization
new WOW().init();


Vue.component('prompt', {
  data: function () {
    return {
      show: true
    }
  },
	props: {
		petData: {}
	},
	created: function () {
		// console.log(this.petData);
	},
  template: `
		<div class="prompt" v-if="show">
			<div class="prompt__close-btn">
				<button @click="show = true">x</button>
			</div>

			<div class="prompt__body">
				{{ petData.petName }}
			</div>

			<div class="prompt__button">
				<button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">OK</button>
			</div>
		</div>
	`
});

var app = new Vue({
  el: '#app',
  data: {
		pets: {}
  },

	filters: {
	  formatDate: function (date) {
	    return moment(date).format('MMM DD, YYYY');
	  }
	},

	methods: {
		// method for posting pet and changing status
		postPet: function(petId) {

			if (window.confirm('Do you want to post new pet?')) {
				axios.get('/pet/postPet/' + petId);

				axios.get('/pet/')
							.then(function(response) {
								location.reload();
							});
			} else {}
		}
	},

	// life cycle  hooks
	created: function() {
		let $this = this;

		axios.get('/pet/getPostedPets/')
								.then(function (response) {
									console.log(response);
									$this.pets = response.data;
								});
	}
});
