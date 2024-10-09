<template>
	<div class="main-containers">
		<div class="body-containers" :style='{"minHeight":"100vh","padding":"170px 0 0","margin":"0","position":"relative","background":"#F7F5F7"}'>
		<div class="top-container" :style='{"boxShadow":"0px 4px 10px 0px rgba(0,0,0,0.3)","padding":"0 20px 0 35%","alignItems":"flex-start","display":"flex","justifyContent":"flex-end","overflow":"hidden","top":"0","left":"0","background":"#ffffff","width":"100%","position":"absolute","height":"170px","zIndex":"1002"}'>
			<!-- info -->
			<div :style='{"padding":"0 20px","position":"absolute","alignItems":"center","left":"0","display":"flex","height":"120px"}'>
			  <el-image :style='{"width":"124px","objectFit":"cover","borderRadius":"0","float":"left","height":"94px"}' src="http://codegen.caihongy.cn/20240120/58d4fa693d4f4c6587c4cf5ed0c320ef.png" fit="cover" />
			  <span @click="goMenu('/index/home')" :style='{"padding":"0 0 0 12px","lineHeight":"44px","fontSize":"36px","color":"#4261A6","float":"left"}'>校园Flea Market售货平台</span>
			</div>
			
			<div v-if="false" :style='{"color":"#666","margin":"0 10px","fontSize":"14px"}'>0753-1234567</div>
			<el-button v-if="Token" class="btn-shop" @click.native="goMenu('/index/cart')">
				<span class="icon iconfont icon-wuliu8" :style='{"color":"inherit","fontSize":"inherit"}'></span>
				购物车
			</el-button>
			
			<img v-if="headportrait&&Token" :style='{"width":"50px","margin":"20px 12px","borderRadius":"50%","height":"50px","order":"5"}' :src="headportrait?baseUrl + headportrait:require('@/assets/avator.png')">
			<div v-if="Token" :style='{"padding":"0 10px","fontSize":"16px","lineHeight":"90px","color":"#3554A4","height":"90px","order":"6"}'>{{username}}</div>
			<div v-if="Token && notAdmin" :style='{"padding":"0 10px","fontSize":"16px","lineHeight":"90px","color":"#3554A4","height":"90px","order":"7"}' @click="goMenu('/index/center')">个人中心</div>
			<el-button v-if="!Token" @click="toLogin()" :style='{"border":"none","padding":"0 12px","margin":"0 10px","color":"#3554A4","borderRadius":"0","background":"none","display":"inline-block","fontSize":"16px","lineHeight":"90px","fontWeight":"bold","height":"90px","order":"8"}'>登录/注册</el-button>
			<el-button v-if="Token" @click="logout" :style='{"border":"none","padding":"0 12px","margin":"0 10px","color":"#3554A4","borderRadius":"0","background":"none","display":"inline-block","fontSize":"16px","lineHeight":"90px","fontWeight":"bold","height":"90px","order":"9"}'>退出</el-button>
		</div>


			<div class="menu-preview" :style='{"padding":"0 20px","borderColor":"#efefef","top":"90px","left":"10%","background":"#ffffff","borderWidth":"0","width":"90%","position":"absolute","borderStyle":"solid","height":"auto","zIndex":"1004"}'>
			<el-scrollbar wrap-class="scrollbar-wrapper-horizontal">
				<el-menu class="el-menu-horizontal-demo" :style='{"border":0,"padding":"15px 0","listStyle":"none","margin":"0","background":"#FFF","display":"flex","position":"relative","justifyContent":"center","height":"80px"}' :default-active="activeMenu" :unique-opened="true" mode="horizontal" :router="true" @select="handleSelect">
					<div class="userinfo" :style='{"width":"84px","padding":"6px 10px 0","display":"none","height":"auto"}'>
					  <el-image v-if="headportrait&&Token" :style='{"width":"100%","objectFit":"cover","borderRadius":"20px","display":"block","height":"32px"}' :src="headportrait?baseUrl + headportrait:require('@/assets/avator.png')" fit="cover"></el-image>
					  <div :style='{"fontSize":"12px","lineHeight":"1.5","color":"#333","textAlign":"center"}'>{{username}}</div>
					</div>
					<el-menu-item class="home" index="/index/home" @click.native="goMenu('/index/home')">
						<span :style='{"padding":"0 10px","margin":"0 5px 0 0","color":"inherit","width":"14px","lineHeight":"56px","fontSize":"inherit","height":"56px"}' class="icon iconfont icon-shouye-zhihui"></span>
						<span :style='{"padding":"0 10px","lineHeight":"56px","fontSize":"inherit","color":"inherit","height":"56px"}'>系统首页</span>
					</el-menu-item>
					<el-menu-item class="item" v-for="(menu, index) in menuList" :index="menu.url" :key="index" @click.native="goMenu(menu.url)">
						<i :style='{"padding":"0 10px","margin":"0 5px 0 0","color":"inherit","width":"16px","lineHeight":"56px","fontSize":"inherit","height":"56px"}' :class="iconArr[index]"></i>
						<span :style='{"padding":"0 10px","lineHeight":"56px","fontSize":"inherit","color":"inherit","height":"56px"}'>{{menu.name}}</span>
					</el-menu-item>
					<el-menu-item class="shop" v-if="Token" index="/index/cart" @click.native="goMenu('/index/cart')">
						<span :style='{"padding":"0 10px","margin":"0 5px 0 0","color":"inherit","width":"14px","lineHeight":"56px","fontSize":"inherit","height":"56px"}' class="icon iconfont icon-wuliu8"></span>
						<span :style='{"padding":"0 10px","lineHeight":"56px","fontSize":"inherit","color":"inherit","height":"56px"}'>购物车</span>
					</el-menu-item>
					<el-menu-item class="user" index="/index/center" v-if="Token && notAdmin" @click.native="goMenu('/index/center')">
						<span :style='{"padding":"0 10px","margin":"0","color":"inherit","width":"14px","lineHeight":"56px","fontSize":"14px","height":"56px"}' class="icon iconfont icon-shouye-zhihui"></span>
						<span :style='{"padding":"0 10px","lineHeight":"56px","fontSize":"14px","color":"inherit","height":"56px"}'>个人中心</span>
					</el-menu-item>
				</el-menu>
			</el-scrollbar>
			</div>


			<div class="banner-preview" :style='{"width":"100%","height":"auto"}'>
				<el-carousel :style='{"width":"100%","margin":"0 auto"}' trigger="click" indicator-position="inside" arrow="always" type="default" direction="horizontal" height="400px" :autoplay="true" :interval="3000" :loop="true">
					<el-carousel-item :style='{"borderRadius":"0","width":"100%","height":"100%"}' v-for="item in carouselList" :key="item.id">
						<el-image v-if="preHttp(item.value)" @click="carouselClick(item.url)" :style='{"objectFit":"cover","width":"100%","height":"100%"}' :src="item.value" fit="cover"></el-image>
						<el-image v-else @click="carouselClick(item.url)" :style='{"objectFit":"cover","width":"100%","height":"100%"}' :src="baseUrl + item.value" fit="cover"></el-image>
					</el-carousel-item>
				</el-carousel>
			</div>


			<router-view id="scrollView"></router-view>
			
			<div class="bottom-preview" :style='{"width":"100%","height":"auto"}'>
				<div :style='{"minHeight":"100px","padding":"20px","overflow":"hidden","color":"#fff","background":"#000","width":"100%","height":"auto"}'><div v-html="bottomContent"></div></div>
			</div>
		</div>
		
	</div>
</template>

<script>
import Vue from 'vue'
import Swiper from "swiper";
import axios from 'axios'

export default {
    data() {
		return {
            activeIndex: '0',
			roleMenus: [{"backMenu":[{"child":[{"allButtons":["新增","查看","修改","删除"],"appFrontIcon":"cuIcon-copy","buttons":["新增","查看","修改","删除"],"menu":"用户","menuJump":"列表","tableName":"yonghu"}],"menu":"用户管理"},{"child":[{"allButtons":["新增","查看","修改","删除"],"appFrontIcon":"cuIcon-pic","buttons":["新增","查看","修改","删除"],"menu":"商家","menuJump":"列表","tableName":"shangjia"}],"menu":"商家管理"},{"child":[{"allButtons":["新增","查看","修改","删除"],"appFrontIcon":"cuIcon-wenzi","buttons":["新增","查看","修改","删除"],"menu":"商品分类","menuJump":"列表","tableName":"shangpinfenlei"}],"menu":"商品分类管理"},{"child":[{"allButtons":["新增","查看","修改","删除","查看评论"],"appFrontIcon":"cuIcon-cardboard","buttons":["查看","修改","删除","查看评论"],"menu":"商品信息","menuJump":"列表","tableName":"shangpinxinxi"}],"menu":"商品信息管理"},{"child":[{"allButtons":["新增","查看","修改","删除"],"appFrontIcon":"cuIcon-group","buttons":["查看","修改","删除"],"menu":"论坛交流","tableName":"forum"}],"menu":"论坛交流"},{"child":[{"allButtons":["查看","修改"],"appFrontIcon":"cuIcon-album","buttons":["查看","修改"],"menu":"系统简介","tableName":"systemintro"},{"allButtons":["新增","查看","修改","删除"],"appFrontIcon":"cuIcon-news","buttons":["新增","查看","修改","删除"],"menu":"通知公告","tableName":"news"},{"allButtons":["新增","查看","修改","删除"],"appFrontIcon":"cuIcon-news","buttons":["新增","查看","修改","删除"],"menu":"通知公告分类","tableName":"newstype"},{"allButtons":["查看","修改"],"appFrontIcon":"cuIcon-addressbook","buttons":["查看","修改"],"menu":"关于我们","tableName":"aboutus"},{"allButtons":["新增","查看","修改","删除"],"appFrontIcon":"cuIcon-shop","buttons":["查看","修改","删除"],"menu":"轮播图管理","tableName":"config"}],"menu":"系统管理"},{"child":[{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额","物流","退货审核"],"appFrontIcon":"cuIcon-rank","buttons":["查看","修改","删除","日销量","月销量","年销量","类销量","日销额","月销额","年销额","类销额"],"menu":"已完成订单","tableName":"orders/已完成"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额"],"appFrontIcon":"cuIcon-album","buttons":["查看","修改","删除"],"menu":"已取消订单","tableName":"orders/已取消"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额","物流"],"appFrontIcon":"cuIcon-list","buttons":["查看","修改","删除"],"menu":"已退款订单","tableName":"orders/已退款"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额","确认收货","物流"],"appFrontIcon":"cuIcon-album","buttons":["查看","修改","删除"],"menu":"已发货订单","tableName":"orders/已发货"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额"],"appFrontIcon":"cuIcon-keyboard","buttons":["查看","修改","删除"],"menu":"未支付订单","tableName":"orders/未支付"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额","发货","物流","核销"],"appFrontIcon":"cuIcon-goodsnew","buttons":["查看","修改","删除"],"menu":"已支付订单","tableName":"orders/已支付"}],"menu":"订单管理"}],"frontMenu":[{"child":[{"allButtons":["新增","查看","修改","删除","查看评论"],"appFrontIcon":"cuIcon-vipcard","buttons":["查看","查看评论"],"menu":"商品信息列表","menuJump":"列表","tableName":"shangpinxinxi"}],"menu":"商品信息模块"}],"hasBackLogin":"是","hasBackRegister":"否","hasFrontLogin":"否","hasFrontRegister":"否","roleName":"管理员","tableName":"users"},{"backMenu":[{"child":[{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额","确认收货","物流"],"appFrontIcon":"cuIcon-album","buttons":["确认收货"],"menu":"已发货订单","tableName":"orders/已发货"}],"menu":"订单管理"}],"frontMenu":[{"child":[{"allButtons":["新增","查看","修改","删除","查看评论"],"appFrontIcon":"cuIcon-vipcard","buttons":["查看","查看评论"],"menu":"商品信息列表","menuJump":"列表","tableName":"shangpinxinxi"}],"menu":"商品信息模块"}],"hasBackLogin":"否","hasBackRegister":"否","hasFrontLogin":"是","hasFrontRegister":"是","roleName":"用户","tableName":"yonghu"},{"backMenu":[{"child":[{"allButtons":["新增","查看","修改","删除","查看评论"],"appFrontIcon":"cuIcon-cardboard","buttons":["新增","查看","修改","删除","查看评论"],"menu":"商品信息","menuJump":"列表","tableName":"shangpinxinxi"}],"menu":"商品信息管理"},{"child":[{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额","物流"],"appFrontIcon":"cuIcon-list","buttons":["查看","删除"],"menu":"已退款订单","tableName":"orders/已退款"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额","确认收货","物流"],"appFrontIcon":"cuIcon-album","buttons":["查看","删除"],"menu":"已发货订单","tableName":"orders/已发货"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额"],"appFrontIcon":"cuIcon-keyboard","buttons":["查看","删除"],"menu":"未支付订单","tableName":"orders/未支付"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额","发货","物流","核销"],"appFrontIcon":"cuIcon-goodsnew","buttons":["查看","删除","发货"],"menu":"已支付订单","tableName":"orders/已支付"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额","物流","退货审核"],"appFrontIcon":"cuIcon-rank","buttons":["查看","删除","日销量","月销量","年销量","类销量","日销额","月销额","年销额","类销额","退货审核"],"menu":"已完成订单","tableName":"orders/已完成"},{"allButtons":["新增","查看","修改","删除","导出","日销量","月销量","年销量","品销量","类销量","日销额","月销额","年销额","品销额","类销额"],"appFrontIcon":"cuIcon-album","buttons":["查看","删除"],"menu":"已取消订单","tableName":"orders/已取消"}],"menu":"订单管理"}],"frontMenu":[{"child":[{"allButtons":["新增","查看","修改","删除","查看评论"],"appFrontIcon":"cuIcon-vipcard","buttons":["查看","查看评论"],"menu":"商品信息列表","menuJump":"列表","tableName":"shangpinxinxi"}],"menu":"商品信息模块"}],"hasBackLogin":"是","hasBackRegister":"是","hasFrontLogin":"否","hasFrontRegister":"否","roleName":"商家","tableName":"shangjia"}],
			baseUrl: '',
			carouselList: [],
			menuList: [],
			form: {
				ask: '',
				userid: localStorage.getItem('frontUserid')
			},
			headportrait: localStorage.getItem('frontHeadportrait')?localStorage.getItem('frontHeadportrait'):'',
			Token: localStorage.getItem('frontToken'),
            username: localStorage.getItem('username'),
            notAdmin: localStorage.getItem('frontSessionTable')!='"users"',
			timer: '',
			iconArr: [
				'el-icon-star-off',
				'el-icon-goods',
				'el-icon-warning',
				'el-icon-question',
				'el-icon-info',
				'el-icon-help',
				'el-icon-picture-outline-round',
				'el-icon-camera-solid',
				'el-icon-video-camera-solid',
				'el-icon-video-camera',
				'el-icon-bell',
				'el-icon-s-cooperation',
				'el-icon-s-order',
				'el-icon-s-platform',
				'el-icon-s-operation',
				'el-icon-s-promotion',
				'el-icon-s-release',
				'el-icon-s-ticket',
				'el-icon-s-management',
				'el-icon-s-open',
				'el-icon-s-shop',
				'el-icon-s-marketing',
				'el-icon-s-flag',
				'el-icon-s-comment',
				'el-icon-s-finance',
				'el-icon-s-claim',
				'el-icon-s-opportunity',
				'el-icon-s-data',
				'el-icon-s-check'
			],
			bottomContent: '',
		}
    },
    created() {
		this.baseUrl = this.$config.baseUrl;
		this.menuList = this.$config.indexNav;
		this.getCarousel();
        if(localStorage.getItem('frontToken') && localStorage.getItem('frontToken')!=null) {
			this.getSession()
        }
    },
    mounted() {
        this.activeIndex = localStorage.getItem('keyPath') || '0';



    },
    computed: {
		activeMenu() {
			const route = this.$route
			const {
				meta,
				path
			} = route
			// if st path, the sidebar will highlight the path you sete
			if (meta.activeMenu) {
				return meta.activeMenu
			}
			return path
		},
    },
    watch: {
        $route(newValue) {
            let that = this
            let url = window.location.href
            let arr = url.split('#')
            for (let x in this.menuList) {
                if (newValue.path == this.menuList[x].url) {
                    this.activeIndex = x
                }
            }
            this.Token = localStorage.getItem('frontToken')
            if(arr[1]!='/index/home'){
            	var element = document.getElementById('scrollView');
            	var distance = element.offsetTop;
            	window.scrollTo( 0, distance )
            }else{
            	window.scrollTo( 0, 0 )
            }
        },
		headportrait(){
			this.$forceUpdate()
		},
    },
    methods: {
		preHttp(str) {
			return str && str.substr(0,4)=='http';
		},

		async getSession() {
			await this.$http.get(`${localStorage.getItem('UserTableName')}/session`, {emulateJSON: true}).then(async res => {
				if (res.data.code == 0) {
					localStorage.setItem('sessionForm',JSON.stringify(res.data.data))
					localStorage.setItem('frontUserid', res.data.data.id);
					if(res.data.data.vip) {
						localStorage.setItem('vip', res.data.data.vip);
					}
					if(res.data.data.touxiang) {
						this.headportrait = res.data.data.touxiang
						localStorage.setItem('frontHeadportrait', res.data.data.touxiang);
					} else if(res.data.data.headportrait) {
						this.headportrait = res.data.data.headportrait
						localStorage.setItem('frontHeadportrait', res.data.data.headportrait);
					}
				}
			});
		},
        handleSelect(keyPath) {
            if (keyPath) {
                localStorage.setItem('keyPath', keyPath)
            }
        },
		toLogin() {
		  this.$router.push('/login');
		},
        logout() {
            localStorage.clear();
            Vue.http.headers.common['Token'] = "";
            this.$router.push('/index/home');
            this.activeIndex = '0'
            localStorage.setItem('keyPath', this.activeIndex)
            this.Token = ''
            this.$forceUpdate()
            this.$message({
                message: '登出成功',
                type: 'success',
                duration: 1000,
            });
        },
		getCarousel() {
			this.$http.get('config/list', {params: { page: 1, limit: 3 }}).then(res => {
				if (res.data.code == 0) {
					this.carouselList = res.data.data.list;
				}
			});
		},
		// 轮播图跳转
		carouselClick(url) {
			if (url) {
				if (url.indexOf('https') != -1) {
					window.open(url)
				} else {
					this.$router.push(url)
				}
			}
		},
		goBackend() {
			localStorage.setItem('Token', localStorage.getItem('frontToken'));
			localStorage.setItem('role', localStorage.getItem('frontRole'));
			localStorage.setItem('sessionTable', localStorage.getItem('frontSessionTable'));
			localStorage.setItem('headportrait', localStorage.getItem('frontHeadportrait'));
			localStorage.setItem('userid', localStorage.getItem('frontUserid'));
			window.location.href = `${this.$config.baseUrl}admin/dist/index.html`
			
		},
		goMenu(path) {
            this.$router.push(path);
		},
    }
}
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
	.menu-preview {
	  .el-scrollbar {
	    height: 100%;
	  
	    & /deep/ .scrollbar-wrapper-vertical {
	      overflow-x: hidden;
	    }
	  
	    & /deep/ .scrollbar-wrapper-horizontal {
	      overflow-y: hidden;
	  
	      .el-scrollbar__view {
	        white-space: nowrap;
	      }
	    }
	  }
	}
	
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.home {
				cursor: pointer;
				border: 0;
				padding: 0 5px 0 20px;
				color: #000;
				white-space: nowrap;
				display: flex;
				font-size: 18px;
				line-height: 36px;
				background: none;
				align-items: center;
				position: relative;
				list-style: none;
				height: 36px;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.home:hover {
				color: #FE6917;
				background: none;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.home.is-active {
				color: #FE6917;
				background: none;
				font-weight: bold;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.user {
				cursor: pointer;
				border: 0;
				padding: 0 20px;
				color: #333;
				white-space: nowrap;
				display: none;
				font-size: 14px;
				line-height: 56px;
				background: #fff;
				align-items: center;
				position: relative;
				list-style: none;
				height: 56px;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.user:hover {
				color: #fff;
				background: red;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.user.is-active {
				color: #fff;
				background: blue;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.service {
				cursor: pointer;
				border: 0;
				padding: 0 20px;
				color: #333;
				white-space: nowrap;
				display: none;
				font-size: 14px;
				line-height: 56px;
				background: #fff;
				align-items: center;
				position: relative;
				list-style: none;
				height: 56px;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.service:hover {
				color: #fff;
				background: red;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.service.is-active {
				color: #fff;
				background: blue;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.shop {
				cursor: pointer;
				border: 1px solid #000;
				padding: 0 5px;
				color: #000;
				white-space: nowrap;
				display: flex;
				font-size: 18px;
				line-height: 36px;
				background: none;
				border-width: 0 0 0 2px;
				align-items: center;
				position: relative;
				list-style: none;
				height: 36px;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.shop:hover {
				color: #FE6917;
				background: none;
				font-weight: bold;
				border-color: #FE6917;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.shop.is-active {
				color: #FE6917;
				background: none;
				font-weight: bold;
				border-color: #FE6917;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.back {
				cursor: pointer;
				border: 1px solid #000;
				padding: 0 5px;
				color: #000;
				white-space: nowrap;
				display: flex;
				font-size: 18px;
				line-height: 36px;
				background: none;
				border-width: 0 0 0 2px;
				align-items: center;
				position: relative;
				list-style: none;
				height: 36px;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.back:hover {
				color: #FE6917;
				background: none;
				font-weight: bold;
				border-color: #FE6917;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.back.is-active {
				color: #FE6917;
				background: none;
				font-weight: bold;
				border-color: #FE6917;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.item {
				cursor: pointer;
				border: 1px solid #000;
				padding: 0 5px;
				color: #000;
				white-space: nowrap;
				display: flex;
				font-size: 18px;
				line-height: 1;
				background: none;
				border-width: 0 0 0 2px;
				align-items: center;
				position: relative;
				list-style: none;
				height: 36px;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.item:hover {
				color: #FE6917;
				background: none;
				font-weight: bold;
				border-color: #FE6917;
			}
	
	.menu-preview .el-menu-horizontal-demo .el-menu-item.item.is-active {
				color: #FE6917;
				background: none;
				font-weight: bold;
				border-color: #FE6917;
			}
	
	.banner-preview {
	  .el-carousel /deep/ .el-carousel__indicator button {
	    width: 0;
	    height: 0;
	    display: none;
	  }
	}
	
	.banner-preview .el-carousel /deep/ .el-carousel__container .el-carousel__arrow--left {
		width: 36px;
		font-size: 12px;
		height: 36px;
	}
	
	.banner-preview .el-carousel /deep/ .el-carousel__container .el-carousel__arrow--left:hover {
		background: red;
	}
	
	.banner-preview .el-carousel /deep/ .el-carousel__container .el-carousel__arrow--right {
		width: 36px;
		font-size: 12px;
		height: 36px;
	}
	
	.banner-preview .el-carousel /deep/ .el-carousel__container .el-carousel__arrow--right:hover {
		background: red;
	}

	.banner-preview .el-carousel /deep/ .el-carousel__indicators {
		padding: 0;
		margin: 0;
		z-index: 2;
		position: absolute;
		list-style: none;
	}
	
	.banner-preview .el-carousel /deep/ .el-carousel__indicators li {
		padding: 0;
		margin: 0 4px;
		background: #3554A4;
		display: inline-block;
		width: 12px;
		opacity: 0.8;
		transition: 0.3s;
		height: 12px;
	}
	
	.banner-preview .el-carousel /deep/ .el-carousel__indicators li:hover {
		padding: 0;
		margin: 0 4px;
		background: #FE6917;
		display: inline-block;
		width: 24px;
		opacity: 0.7;
		height: 12px;
	}
	
	.banner-preview .el-carousel /deep/ .el-carousel__indicators li.is-active {
		padding: 0;
		margin: 0 4px;
		background: #FE6917;
		display: inline-block;
		width: 24px;
		opacity: 1;
		height: 12px;
	}

    .chat-content {
        padding-bottom: 20px;
        width: 100%;
        margin-bottom: 10px;
        max-height: 300px;
        height: 300px;
        overflow-y: scroll;
        border: 1px solid #eeeeee;
        background: #fff;

        .left-content {
            float: left;
            margin-bottom: 10px;
            padding: 10px;
            max-width: 80%;
        }

        .right-content {
            float: right;
            margin-bottom: 10px;
            padding: 10px;
            max-width: 80%;
        }
    }

    .clear-float {
        clear: both;
    }


	
	// -------- search --------
	.main-containers .search .select /deep/ .el-input__inner {
				border: 0;
				border-radius: 4px;
				padding: 0 30px 0 10px;
				box-shadow: 0 0 6px rgba(64, 158, 255, .3);
				outline: none;
				color: rgba(64, 158, 255, 1);
				width: 180px;
				font-size: 14px;
				height: 44px;
			}
	
	.main-containers .search .input /deep/ .el-input__inner {
				border: 0;
				border-radius: 4px;
				padding: 0 10px;
				box-shadow: 0 0 6px rgba(64, 158, 255, .3);
				outline: none;
				color: rgba(64, 158, 255, 1);
				width: 180px;
				font-size: 14px;
				height: 44px;
			}
	// -------- search --------
	
	.main-containers .btn-service {
				border: 0;
				padding: 0;
				margin: 0 10px;
				color: #3554A4;
				background: none;
				width: auto;
				font-size: 16px;
				line-height: 90px;
				height: 90px;
				order: 4;
			}
	
	.main-containers .btn-service:hover {
				opacity: 0.8;
			}
	
	.main-containers .btn-shop {
				border: 0;
				padding: 0;
				margin: 0 10px;
				color: #3554A4;
				background: none;
				display: none;
				width: auto;
				font-size: 16px;
				line-height: 90px;
				height: 90px;
			}
	
	.main-containers .btn-shop:hover {
				opacity: 0.8;
			}
</style>
