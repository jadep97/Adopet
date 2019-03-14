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
		imgSrc: '',
		petDetail: {},
		petImages: []
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
			this.petImages = JSON.parse(pet.petImg);
		}
	},

	// life cycle  hooks
	created: function() {
		let $this = this;

		axios.get('/pet/getPostedPets/')
								.then(function (response) {
									$this.pets = response.data;

									// console.log($this.pets);
									// var a = JSON.parse("["05-512.png","9c887c760825a6122b9b85063aa5628d--secret-life-of-pets-wallpaper-cellphone-wallpaper.jpg","800px_COLOURBOX21686142.jpg"]");

									// var st = '["05-512.png","9c887c760825a6122b9b85063aa5628d--secret-life-of-pets-wallpaper-cellphone-wallpaper.jpg","800px_COLOURBOX21686142.jpg"]';

									// console.log(JSON.parse($this.pets[0].petImg));


									// if($this.pets) {
									// 	for(i in $this.pets) {
									// 		var arr = JSON.parse($this.pets[i].petImg);
									// 		$this.pets[i].petImg = [];
									// 		$this.pets[i].petImg = arr;
									// 		// let arr = JSON.parse(pets[i].petImage);
									// 		// console.log(pets[i]);
											// console.log(JSON.parse($this.pets[i].petImg));
									// 		// console.log(arr);
									//
									//
									// 		// $this.pets[i].petImg = JSON.parse($this.pets[i].petImage);
											// console.log(response.data);
									// 	}
									// }
									// // $this.pets = response.data;
									//
									// // console.log(JSON.parse($this.pets[0].petImg));
									// // console.log($this.pets);
								});
	}
});
