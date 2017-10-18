<template>
	<div class="page-mobile-menu-component sidebar-menu" v-if="isVisible">
		<div class="mobile-heading">
			<div class="page-title">{{ page.title }}</div>
			<div class="current">
				contenido
				<span class="caret"></span>
			</div>
		</div>
        <div id="collapseNav">
            <ol type="1" class="nav index" data-gumshoe>
                <li><a :href="currentUrl+'#objective'" data-target="#objective">Descripción</a></li>
                <li v-if="page.details"><a :href="currentUrl+'#details'" data-target="#details">Detalles</a></li>
                <li><a :href="currentUrl+'#beneficiaries'" data-target="#beneficiaries">¿A quién está dirigido?</a></li>
                <li v-if="page.requirements"><a :href="currentUrl+'#requirements'" data-target="#requirements">¿Qué necesito para hacer el trámite?</a></li>
                <li v-if="page.howto"><a :href="currentUrl+'#howto'" data-target="#howto">¿Cómo y dónde hago el trámite? </a></li>
            </ol>
            <a v-if="page.online" class="btn btn-online" href="<?=$page->online_url?>" target="_blank">Ir al trámite en línea</a>
        </div>
    </div>
</template>
<script>

	export default {
		props: {
			'page': {
				type: Object
			},
			'currentUrl' : {
				type: String
			}
		},
		data() {
			return {
				top: null,
				scrollTop: null
			}
		},
		mounted() {
			this.calculateTop(document.getElementById('objective'));
			window.addEventListener('scroll', (e) => {
				this.handleScroll();
			});
			console.log('lala');
		},
		computed: {
			isVisible() {
				// return this.scrollTop > this.top;
				return true;
			}
		},
		methods: {
			calculateTop(elem) {
			    var offsetTop = 0;
			    do {
			      if ( !isNaN( elem.offsetTop ) )
			      {
			          offsetTop += elem.offsetTop;
			      }
			    } while( elem = elem.offsetParent );
			    this.top = offsetTop;
			},
			handleScroll() {
				this.scrollTop = window.scrollY || window.scrollTop || document.getElementsByTagName("html")[0].scrollTop;
			}
		}
	}
</script>