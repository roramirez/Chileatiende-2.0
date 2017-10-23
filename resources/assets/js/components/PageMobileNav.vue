<template>
	<div id="page-nav" class="page-mobile-menu-component sidebar-menu" v-bind:class="{ affix: isVisible, 'affix-bottom': isAffix }" style="">
		<div class="mobile-heading">
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
                <li><a :href="currentUrl+'#beneficiaries'" data-target="#beneficiaries">¿A quién está dirigido?</a></li>
                <li v-if="page.requirements"><a :href="currentUrl+'#requirements'" data-target="#requirements">¿Qué necesito para hacer el trámite?</a></li>
                <li v-if="page.howto"><a :href="currentUrl+'#howto'" data-target="#howto">¿Cómo y dónde hago el trámite? </a></li>
            </ol>
            <a v-if="page.online" class="btn btn-online" href="<?=$page->online_url?>" target="_blank">Ir al trámite en línea</a>
        </div>
        <div v-if="page.related_pages.length > 0">
            <h4>Trámites Relacionados</h4>
            <ul>
                <li v-for="p in page.related_pages">
                    <div><a :href="'fichas/'+p.guid">{{p.title}}</a></div>
                    <div v-if="p.online" class="online">Trámite Online</div>
                </li>
            </ul>
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
				activeNavPage: null
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
			this.pageHeight = document.getElementById('page').clientHeight - document.getElementById('need-help').clientHeight;
		},
		computed: {
			isVisible() {
				return this.scrollTop > 330 && this.scrollTop < this.pageHeight;
			},
			isAffix() {
				if (this.scrollTop >= this.pageHeight) {
					$("#page-nav").attr('style', 'top:' + this.pageHeight + 'px');
				}
				else {
					$("#page-nav").attr('style', '');
				}
				return this.scrollTop >= this.pageHeight;
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