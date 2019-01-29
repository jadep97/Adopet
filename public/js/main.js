// Animations initialization
new WOW().init();


// Vue.component('prompt', {
//   data: function () {
//     return {
//       show: true,
//     }
//   },
// 	props: ['text'],
//   template: `
// 		<div class="prompt" v-if="show">
// 			<div class="prompt__close-btn">
// 				<button @click="show = true">x</button>
// 			</div>
//
// 			<div class="prompt__body">
// 				{{ text }}
// 			</div>
//
// 			<div class="prompt__button">
// 				<button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">OK</button>
// 			</div>
// 		</div>
// 	`
// });

var app = new Vue({
  el: '#app',
  data: {
		pets: {}
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
									// console.log(response);
									$this.pets = response.data;
								});
	}
});
