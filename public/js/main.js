// Animations initialization
new WOW().init();


Vue.component('prompt', {
  data: function () {
    return {
      show: false,
    }
  },
	props: ['text'],
  template: `
		<div class="prompt" v-if="show">
			<div class="prompt__close-btn">
				<button @click="show = true">x</button>
			</div>

			<div class="prompt__body">
				{{ text }}
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
    message: 'a!'
  },

	methods: {
		postPet: function(petId) {
			if (window.confirm('Post pet?')) {
				window.axios.get('/pet/postPet/' + petId);
			} else {}
		}
	}
});
