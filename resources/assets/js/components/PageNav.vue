<template>
	<div id="page-nav" class="page-mobile-menu-component sidebar-menu" v-bind:class="{ affix: isAffix,'affix-bottom': isAffixBottom  }" style="">
		<div class="mobile-heading" data-gumshoe-header>
			<div class="page-title">{{ page.title }}</div>
			<a class="current" role="button" data-toggle="collapse" href="#collapseNav">
				{{ activeNavPage }}
				<span class="caret"></span>
			</a>
		</div>
        <div id="collapseNav" class="collapse">
            <ol type="1" class="nav index" data-gumshoe>
                <li><a :href="currentUrl+'#objective'" data-target="#objective">Descripción</a></li>
                <li v-if="page.details"><a :href="currentUrl+'#details'" data-target="#details">Detalles</a></li>
                <li v-if="page.beneficiaries"><a :href="currentUrl+'#beneficiaries'" data-target="#beneficiaries">¿A quién está dirigido?</a></li>
                <li v-if="page.requirements"><a :href="currentUrl+'#requirements'" data-target="#requirements">¿Qué necesito para hacer el trámite?</a></li>
                <li v-if="page.howto"><a :href="currentUrl+'#howto'" data-target="#howto">¿Cómo y dónde hago el trámite? </a></li>
            </ol>
            <a v-if="page.online" class="btn btn-online" :href="page.online_url" data-toggle="modal" data-target="#redirect-modal" data-ga-te-category="Acciones Ficha" data-ga-te-action="Botón Trámite Online Superior" :data-ga-te-value="page.master_id">Ir al trámite en línea →</a>
        </div>
        <div class="clearfix"></div>
        <div v-if="page.related_pages.length > 0" class="hidden-xs hidden-sm">
        	<div class="related-pages">
	            <h4>Trámites Relacionados</h4>
	            <ul>
	                <li v-for="p in page.related_pages">
	                    <div class="title"><a :href="'fichas/'+p.guid">{{p.title}}</a></div>
	                    <div v-if="p.online" class="online">Trámite en Línea</div>
	                </li>
	            </ul>
            </div>
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
				scrollTop: null,
				pageHeight: null,
				navHeight: null,
				activeNavPage: 'Descripción'
			}
		},
		mounted() {
			var self = this;
			gumshoe.init({
	            offset: 30,
	            callback: function(nav) {
	            	if (typeof nav !== 'undefined') {
	                	self.activeNavPage = $(nav.target).text();
	            	}
	            }
	        });
			this.calculateTop(document.getElementById('objective'));
			window.addEventListener('scroll', (e) => {
				this.handleScroll();
			});
			this.pageHeight = document.getElementById('page').offsetHeight - document.getElementById('need-help').offsetHeight - document.getElementById('similar-pages').offsetHeight;
			this.navHeight = document.getElementById('page-nav').offsetHeight;
		},
		computed: {
			isAffix() {
				return this.scrollTop > 350 && this.scrollTop < (this.pageHeight + 350);
			},
			isAffixBottom() {
				if (this.scrollTop >= (this.pageHeight - this.navHeight)) {
					$("#page-nav").attr('style', 'top:' + ((this.pageHeight - this.navHeight) - 350 )  + 'px');
				}
				else {
					$("#page-nav").attr('style', '');
				}
				return this.scrollTop >= (this.pageHeight - this.navHeight);
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
				this.pageHeight = document.getElementById('page').offsetHeight - document.getElementById('need-help').offsetHeight - document.getElementById('similar-pages').offsetHeight;
				this.scrollTop = window.scrollY || window.scrollTop || document.getElementsByTagName("html")[0].scrollTop;
			}
		}
	}
</script>