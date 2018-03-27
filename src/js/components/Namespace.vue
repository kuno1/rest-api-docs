<template>
	<div :class="class_var">
		<div v-for="namespace in namespaces" :class="{'rad-namespace-item': true, active: namespace == active}">
			<button class="rad-namespace-button" @click="select(namespace)">{{namespace}}</button>
		</div>
	</div>
</template>

<script>

  /* global RadVars: false*/
  import WpApi from '../lib/WpApi';

  export default {

    data() {
	  return {
	    labels: RadVars.labels,
		namespaces: [],
		loading: false,
		active: false,
		class_var: {
	      "rad-namespace": true,
		  "loading": this.loading
		}
      }
	},

	methods: {
      select(namespace){
        this.active = namespace;
        this.$emit('selected', namespace);
	  },
	},

	mounted() {
      this.loading = true;
      WpApi.api().get('/').then((res) => {
        this.namespaces = res.data.namespaces;
      }).catch((res)=>{
        this.$emit('error', res);
      }).then(()=>{
        this.loading = false;
      });
	}

  }
</script>

<style scoped>
.loading{
	background: #f00;
}
</style>