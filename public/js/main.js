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
		<div class="prompt" v-if="false">
			<div class="prompt__close-btn">
				<button @click="show = true">x</button>
			</div>

			<div class="prompt__body">

			</div>

			<div class="prompt__button">
				<button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">OK</button>
			</div>
		</div>
	`
});



// vue instation
var app = new Vue({
  el: '#app',
  data: {
		pets: {},
		likes: {},
		imgSrc: '',
		petDetail: {},
		petImages: [],

		comments: {},
  },

	filters: {
	  formatDate: function (date) {
	    	return moment(date).format('MMM D, YYYY');
	  }
	},

	// life cycle  hooks
	created: function() {
		this.getLikedPets();

		if(window.location.href.indexOf("profile") > -1) {
			this.getProfilePets();
		} else {
			this.getPostedPets();
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
		},

		readImg: function(event) {
			var reader = new FileReader();
			reader.onloadend = function (e) {
					$('#imgSrc').attr('src', e .target.result);
				};

			reader.readAsDataURL(event.target.files[0]);
		},

		showModal: function(pet) {
			this.petDetail = pet;
			// this.petComment = pet;
			this.petImages = JSON.parse(pet.petImg);
			this.getCommentPets(pet.id);
		},

		getPostedPets: function() {
			let $this = this;

			axios.get('/pet/getPostedPets/')
						.then(function (response) {
							$this.pets = response.data;
							// console.log(response.data);
						});
		},

		getProfilePets: function() {
			let $this = this;

			axios.get('/pet/getProfilePets/')
						.then(function (response) {
							$this.pets = response.data;
							console.log(response.data);
						});
		},

		getLikedPets: function() {
			let $this = this;

			axios.get('/pet/getLikedPets/')
									.then(function (response) {
										$this.likes = response.data;

										console.log(response.data);
									});

		},

		getCommentPets: function(id) {
			let $this = this;

			axios.get('/pet/getCommentPets/' + id)
									.then(function (response) {
										$this.comments = response.data;

										console.log(response.data);
									});

		},

	},
});
