<template>

	<div :class="class_var">

		<h3 class="rad-endpoints-namespace">{{labels.namespace}}: <code>{{namespace}}</code></h3>

		<div class="rad-endpoints-wrap">

			<div class="rad-endpoints-sidebar">
				<a class="rad-endpoints-link" v-for="(value, key) in routes" :href="'#'+key">
					{{key}}
				</a>
			</div>

			<div class="rad-endpoints-main">

				<div class="rad-endpoints-item" v-for="(value, key) in routes" :id="key">
					<h4 class="rad-endpoints-title">{{key}}
						<small class="rad-endpoints-methods">({{value.methods.join(', ')}})</small>
					</h4>
					<div class="rad-endpoints-list" v-for="method in value.endpoints">
						<h5 class="rad-endpoints-method">{{labels.arguments}} ({{method.methods.join(', ')}})</h5>
						<div class="rad-argumnent-no" v-if="!Object.keys(method.args).length">
							{{labels.no_arguments}}
						</div>
						<table class="rad-argument" v-for="(spec, argument) in method.args">
							<tr>
								<th class="rad-argument-name" rowspan="5">{{argument}}</th>
								<th class="rad-argument-prop">{{labels.type}}</th>
								<td>
									{{spec.type || labels.not_set}}
								</td>
							</tr>
							<tr>
								<th class="rad-argument-prop">{{labels.description}}</th>
								<td>{{spec.description || labels.not_set}}</td>
							</tr>
							<tr>
								<th class="rad-argument-prop">{{labels.required}}</th>
								<td>
									<span class="dashicons dashicons-yes" v-if="spec.required"></span>
									<span class="dashicons dashicons-minus" v-if="!spec.required"></span>
								</td>
							</tr>
							<tr>
								<th class="rad-argument-prop">{{labels.default_value}}</th>
								<td>
									{{'undefined' === typeof spec.default ? labels.not_set : spec.default}}
								</td>
							</tr>
							<tr>
								<th class="rad-argument-prop">{{labels.allowed_value}}</th>
								<td>
									{{spec.enum ? spec.enum.join(', ') : labels.not_set}}
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>

</template>

<script>
  /* global RadVars: false*/
  import WpApi from '../lib/WpApi';

  export default {
    data() {
      return {
        loading  : false,
        routes   : {},
        labels   : RadVars.labels,
        class_var: {
          'rad-container': true,
          'rad-endpoints': true,
          'loading'      : this.loading
        }
      };
    },
    props  : {
      namespace: {
        type    : String,
        required: true
      }
    },
    watch  : {
      namespace: function (namespace) {
        this.fetch();
      },
    },
    mounted: function () {
      this.fetch();
    },
    methods: {
      fetch() {
        this.loading = true;
        WpApi.api().get(this.namespace).then((res) => {
          this.routes = res.data.routes;
        }).catch((res) => {
          this.$emit('error', res);
        }).then(() => {
          this.loading = false;
        });
      },
    }
  }
</script>

<style lang="scss" scoped>
	.item {
		background: #000;
		color: #fff;
		&-title {
			color: #ccc;
		}
	}
</style>