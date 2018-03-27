<template>
	<div class="rad-wrap">
		<div class="rad-namespace">
			<namespace @selected="selected"></namespace>
		</div>
		<div class="rad-main">
			<div v-if="!namespace" class="rad-no-namespace">
				{{labels.no_namespace}}
			</div>
			<list v-if="namespace" :namespace="namespace"></list>
		</div>
	</div>
</template>

<style scoped>
</style>


<script>
  /* global RadVars: false*/
  import List from './List.vue';
  import Namespace from './Namespace.vue';

  export default {
    data() {
      return {
        labels: RadVars.labels,
		namespace: false
      };
    },
	components: {
      List,
	  Namespace,
	},
	mounted: function(){
	},
	methods: {
      selected(namespace){
        this.namespace = namespace;
	  }
	}
  };
</script>
