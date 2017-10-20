<template>
	<div class="transparency-list-component">
       <div class="row ">
            <div class="col-md-12">
                <div class="index-container" data-gumshoe-header data-spy="affix" data-offset-top="250" data-offset-bottom="500">
                    <ul class="index" data-gumshoe>
                        <li v-for="(value, letter) in data.letters">
                        	<a :href="BaseUrl+'#'+letter">{{letter}}</a>
                        </li>
                    </ul>
                </div>  
            </div>
	    </div>
    	<div v-for="(value,letter) in data.letters" class="table-responsive">
	    	<table :id="letter" class="list-table">
	    		<thead>
	    			<tr>
	    				<th>{{letter}}</th>
	    				<th></th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<tr v-for="(content, index) in value">
			        	<td>{{ content.title }}</td>
			        	<td>
			        		<a :href="content.url" target="_blank">{{ content.url }}</a>
			        		<div class="copybtn" :data-clipboard-text="content.url" data-toggle="tooltip" data-placement="bottom" title="Copiar">
			        			<i class="material-icons">content_copy</i>
			        		</div>
			        	</td>
			       	</tr>
	    		</tbody>
	    	</table>
    	</div>
	</div>
</template>
<script>
import Clipboard from 'clipboard';

export default {
	props: ['data', 'BaseUrl'],
	mounted() {
		gumshoe.init({
			offset: 100
		});
		
		new Clipboard('.copybtn');
		
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	},
	methods: {
	}
}
</script>