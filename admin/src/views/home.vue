<template>
<div class="content" :style='{"padding":"30px"}'>
	<!-- notice -->
	<!-- title -->
	<div class="text" :style='{"margin":"30px auto","fontSize":"34px","color":"#385d86","textAlign":"center","fontWeight":"bold"}'>欢迎使用 {{this.$project.projectName}}</div>
	

	
	<!-- echarts -->
</div>
</template>
<script>
//0
import router from '@/router/router-static'
import * as echarts from 'echarts'
export default {
	data() {
		return {
		};
	},
	mounted(){
		this.init();
	},
	methods:{
		init(){
			if(this.$storage.get('Token')){
			this.$http({
				url: `${this.$storage.get('sessionTable')}/session`,
				method: "get"
			}).then(({ data }) => {
				if (data && data.code != 0) {
				router.push({ name: 'login' })
				}
			});
			}else{
				router.push({ name: 'login' })
			}
		},
  }
};
</script>
<style lang="scss" scoped>
    .cardView {
        display: flex;
        flex-wrap: wrap;
        width: 100%;

        .cards {
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 10px;
            justify-content: center;
            .card {
                width: calc(25% - 20px);
                margin: 0 10px;
                /deep/.el-card__body{
                    padding: 0;
                }
            }
        }
    }
	
	// 日历
	.calendar td .text {
				border-radius: 12px;
				flex-direction: column;
				background: #fff;
				display: flex;
				width: 100%;
				justify-content: center;
				align-items: center;
				height: 100%;
			}
	.calendar td .text:hover {
				background: rgba(78,110,242,.1);
			}
	.calendar td .text .new {
				color: #000;
				font-size: 24px;
				line-height: 1.4;
			}
	.calendar td .text .old {
				color: #666;
				font-size: 16px;
				line-height: 1.4;
			}
	.calendar td.festival .text {
				border-radius: 12px;
				flex-direction: column;
				background: rgba(235,51,51,.05);
				display: flex;
				width: 100%;
				justify-content: center;
				align-items: center;
				height: 100%;
			}
	.calendar td.festival .text:hover {
				background: rgba(78,110,242,.1);
			}
	.calendar td.festival .text .new {
				color: #000;
				font-size: 24px;
				line-height: 1.4;
			}
	.calendar td.festival .text .old {
				color: #666;
				font-size: 16px;
				line-height: 1.4;
			}
	.calendar td.other .text {
				border-radius: 12px;
				flex-direction: column;
				background: #fff;
				display: flex;
				width: 100%;
				justify-content: center;
				align-items: center;
				opacity: 0.3;
				height: 100%;
			}
	.calendar td.other .text:hover {
				background: rgba(78,110,242,.1);
			}
	.calendar td.other .text .new {
				color: #000;
				font-size: 24px;
				line-height: 1.4;
			}
	.calendar td.other .text .old {
				color: #666;
				font-size: 16px;
				line-height: 1.4;
			}
	.calendar td.today .text {
				border-radius: 12px;
				flex-direction: column;
				color: #fff;
				background: linear-gradient(rgb(93, 129, 166), rgb(67, 102, 140));
				display: flex;
				width: 100%;
				justify-content: center;
				align-items: center;
				height: 100%;
			}
	.calendar td.today .text:hover {
				background: linear-gradient(rgb(93, 129, 166), rgb(67, 102, 140));
			}
	.calendar td.today .text .new {
				color: inherit;
				font-size: 24px;
				line-height: 1.4;
			}
	.calendar td.today .text .old {
				color: inherit;
				font-size: 16px;
				line-height: 1.4;
			}
	
	// echarts1
	.type1 .echarts1 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 100%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type1 .echarts1:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	// echarts2
	.type2 .echarts1 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type2 .echarts1:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type2 .echarts2 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type2 .echarts2:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	// echarts3
	.type3 .echarts1 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 100%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type3 .echarts1:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type3 .echarts2 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type3 .echarts2:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type3 .echarts3 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type3 .echarts3:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	// echarts4
	.type4 .echarts1 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type4 .echarts1:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type4 .echarts2 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type4 .echarts2:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type4 .echarts3 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type4 .echarts3:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type4 .echarts4 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type4 .echarts4:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	// echarts5
	.type5 .echarts1 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 100%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type5 .echarts1:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type5 .echarts2 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type5 .echarts2:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type5 .echarts3 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type5 .echarts3:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type5 .echarts4 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type5 .echarts4:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	.type5 .echarts5 {
				border: 1px solid #355749;
				border-radius: 8px;
				padding: 20px;
				margin: 10px 0;
				background: rgba(255,255,255,.9);
				width: 49%;
				position: relative;
				transition: 0.3s;
				height: 400px;
			}
	.type5 .echarts5:hover {
				box-shadow: 1px 1px 20px rgba(255,255,255,.12);
				transform: translate3d(0, -10px, 0);
				z-index: 1;
				background: rgba(56,93,134,0.3);
			}
	
	.echarts-flag-2 {
	  display: flex;
	  flex-wrap: wrap;
	  justify-content: space-between;
	  padding: 10px 20px;
	  background: rebeccapurple;
	
	  &>div {
	    width: 32%;
	    height: 300px;
	    margin: 10px 0;
	    background: rgba(255,255,255,.1);
	    border-radius: 8px;
	    padding: 10px 20px;
	  }
	}
</style>
