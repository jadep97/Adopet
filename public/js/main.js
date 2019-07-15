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
		requests: {},
		userRequests: {},
		imgSrc: '',
		petDetail: {},
		petImages: [],
		chats: {},
		comments: {},

		message: '',
		isEmptyMessage: true,
		showPetRequestPanel: false
  },

	watch: {
		message: function(val) {
			 this.isEmptyMessage = val == '' ? true : false;
		}
	},

	filters: {
	  formatDate: function (date) {
	    	return moment(date).format('hh:mm a MMM DD, YYYY');
	  }
	},

	// life cycle  hooks
	created: function() {
		this.getLikedPets();

		if(this.inPage('chat')) {
			this.getChatPet();
		}

		if(this.inPage('profile')) {
			this.getProfilePets();
			this.getRequestPets();
		}
		else {
			this.getPostedPets();
		}
	},

	methods: {
		// method for posting pet and changing status
		asdf: function() {
			window.confirm('asdf');
		},

		inPage: function(page) {
			return window.location.href.indexOf(page) > -1
		},

		postPet: function(petId) {
			if (window.confirm('Do you want to post this pet?')) {
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
					$('#imgSrc').attr('src', e.target.result);
				};

			reader.readAsDataURL(event.target.files[0]);
		},

		showModal: function(pet) {
			this.petDetail = pet;
			// this.petComment = pet;
			this.petImages = JSON.parse(pet.petImg);

			if(this.comments.length == 0) { // to check if comment object has been emptied out

			}
			this.getCommentPets(pet.id);
			this.getUserRequests(pet.id);
		},

		postComment: function(petId) {
			let $this = this;
			if(!this.isEmptyMessage) {
				axios.get('/pet/commentPet/' + petId, { params: { petComment: $this.message }})
							.then(function (response) {
								if(response.status == 200) {
									$this.appendNewComment();
									$this.message = '';
								}
							});
			}
		},

		resetModal: function() {
			this.isEmptyMessage = false;
			this.showPetRequestPanel = false;
			this.clearAppendedComments();
			this.comments = [];
		},

		appendNewComment: function() {
			let panel = document.querySelector('.appended-comments');
			let h6 = document.createElement('h6');
			h6.innerHTML += `
				<span class="font-weight-bold blue-text">`+ window.currentUser.first_name +`:</span>
				<span class="com-comments">`+ this.message +`</span>
				<span class="date-comments">`+ moment().format('hh:mm a MMM DD, YYYY') +`</span>
			`;

			panel.appendChild(h6);
		},

		clearAppendedComments: function() {
			let appendedComments = document.querySelector('.appended-comments');

			appendedComments.innerHTML = '';
		},

		getPostedPets: function() {
			let $this = this;

			axios.get('/pet/getPostedPets/')
						.then(function (response) {
							$this.pets = response.data;
							console.log(response.data);
						});
		},

		getProfilePets: function() {
			let $this = this;

			axios.get('/pet/getProfilePets/')
						.then(function (response) {
							$this.pets = response.data;
						});
		},

		getChatPets: function() {
			let $this = this;

			axios.get('/pet/getChatPets/')
						.then(function (response) {
							$this.chats = response.data;
						});
		},

		getRequestPets: function() {
			let $this = this;

			axios.get('/pet/getRequestPets/')
									.then(function (response) {
										$this.requests = response.data;
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

			this.comments = [];

			axios.get('/pet/getCommentPets/' + id)
									.then(function (response) {
										$this.comments = response.data;
									});
		},

		getUserRequests: function(id) {
			let $this = this;

			axios.get('/pet/getUserRequests/' + id)
									.then(function (response) {
										$this.userRequests = response.data;
									});
		},
	},
});
