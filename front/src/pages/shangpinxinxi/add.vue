<template>
<div :style='{"width":"80%","padding":"20px","margin":"10px auto","position":"relative","background":"#fff"}'>
    <el-form
	  :style='{"width":"100%","position":"relative","flexWrap":"wrap","justifyContent":"space-between","display":"flex"}'
      class="add-update-preview"
      ref="ruleForm"
      :model="ruleForm"
      :rules="rules"
      label-width="80px"
    >
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="商品条码" prop="shangpintiaoma">
              <el-input v-model="ruleForm.shangpintiaoma" placeholder="商品条码" disabled></el-input>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="商品名称" prop="shangpinmingcheng">
            <el-input v-model="ruleForm.shangpinmingcheng" 
                placeholder="商品名称" clearable :disabled=" false  ||ro.shangpinmingcheng"></el-input>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}'  label="商品分类" prop="shangpinfenlei">
            <el-select v-model="ruleForm.shangpinfenlei" placeholder="请选择商品分类" :disabled=" false  ||ro.shangpinfenlei" >
              <el-option
                  v-for="(item,index) in shangpinfenleiOptions"
                  :key="index"
                  :label="item"
                  :value="item">
              </el-option>
            </el-select>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="商品图片" v-if="type!='cross' || (type=='cross' && !ro.shangpintupian)" prop="shangpintupian">
            <file-upload
            tip="点击上传商品图片"
            action="file/upload"
            :limit="3"
            :multiple="true"
            :fileUrls="ruleForm.shangpintupian?ruleForm.shangpintupian:''"
            @change="shangpintupianUploadChange"
            ></file-upload>
          </el-form-item>
            <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' class="upload" v-else label="商品图片" prop="shangpintupian">
                <img v-if="ruleForm.shangpintupian.substring(0,4)=='http'" class="upload-img" style="margin-right:20px;" v-bind:key="index" :src="ruleForm.shangpintupian.split(',')[0]" width="100" height="100">
                <img v-else class="upload-img" style="margin-right:20px;" v-bind:key="index" v-for="(item,index) in ruleForm.shangpintupian.split(',')" :src="baseUrl+item" width="100" height="100">
            </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="商品规格" prop="shangpinguige">
            <el-input v-model="ruleForm.shangpinguige" 
                placeholder="商品规格" clearable :disabled=" false  ||ro.shangpinguige"></el-input>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="商品品牌" prop="shangpinpinpai">
            <el-input v-model="ruleForm.shangpinpinpai" 
                placeholder="商品品牌" clearable :disabled=" false  ||ro.shangpinpinpai"></el-input>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="上架时间" prop="shangjiashijian">
              <el-date-picker
				  :disabled=" false  ||ro.shangjiashijian"
                  format="yyyy 年 MM 月 dd 日"
                  value-format="yyyy-MM-dd"
                  v-model="ruleForm.shangjiashijian" 
                  type="date"
                  placeholder="上架时间">
              </el-date-picker> 
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="商家账号" prop="shangjiazhanghao">
            <el-input v-model="ruleForm.shangjiazhanghao" 
                placeholder="商家账号" clearable :disabled=" false  ||ro.shangjiazhanghao"></el-input>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="商家名称" prop="shangjiamingcheng">
            <el-input v-model="ruleForm.shangjiamingcheng" 
                placeholder="商家名称" clearable :disabled=" false  ||ro.shangjiamingcheng"></el-input>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="单限" prop="onelimittimes">
            <el-input v-model.number="ruleForm.onelimittimes" 
                placeholder="单限" clearable :disabled=" false  ||ro.onelimittimes"></el-input>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="库存" prop="alllimittimes">
            <el-input v-model.number="ruleForm.alllimittimes" 
                placeholder="库存" clearable :disabled=" false  ||ro.alllimittimes"></el-input>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="价格" prop="price">
			<el-input-number v-model="ruleForm.price" placeholder="价格" :disabled=" false ||ro.price"></el-input-number>
          </el-form-item>
          <el-form-item :style='{"width":"49%","padding":"10px","margin":"0 0 10px","background":"none"}' label="商品介绍" prop="shangpinjieshao">
            <editor 
                :style='{"padding":"0","boxShadow":"none","margin":"0","borderColor":"#E2E3E5","backgroundColor":"#fff","borderRadius":"0","borderWidth":"1px","width":"100%","borderStyle":"solid","height":"auto"}'
                v-model="ruleForm.shangpinjieshao" 
                class="editor" 
                action="file/upload">
            </editor>
          </el-form-item>

      <el-form-item :style='{"width":"100%","padding":"0","margin":"0","textAlign":"center"}'>
        <el-button :style='{"border":"0","cursor":"pointer","padding":"0 10px","margin":"0 20px 0 0","outline":"none","color":"rgba(255, 255, 255, 1)","borderRadius":"4px","background":"#FE6917","width":"auto","lineHeight":"30px","fontSize":"14px","height":"30px"}'  type="primary" @click="onSubmit">提交</el-button>
        <el-button :style='{"border":"0","cursor":"pointer","padding":"0 10px","margin":"0","outline":"none","color":"#fff","borderRadius":"5px","background":"#9E9E9E","width":"auto","lineHeight":"30px","fontSize":"14px","height":"30px"}' @click="back()">返回</el-button>
      </el-form-item>
    </el-form>
</div>
</template>

<script>
  export default {
    data() {
	  let self = this
      return {
        id: '',
        baseUrl: '',
        ro:{
				shangpintiaoma : false,
				shangpinmingcheng : false,
				shangpinfenlei : false,
				shangpintupian : false,
				shangpinguige : false,
				shangpinpinpai : false,
				shangjiashijian : false,
				shangpinjieshao : false,
				shangjiazhanghao : false,
				shangjiamingcheng : false,
				onelimittimes : false,
				alllimittimes : false,
				clicktime : false,
				clicknum : false,
				discussnum : false,
				price : false,
				storeupnum : false,
        },
        type: '',
        userTableName: localStorage.getItem('UserTableName'),
        ruleForm: {
          shangpintiaoma: this.getUUID(),
          shangpinmingcheng: '',
          shangpinfenlei: '',
          shangpintupian: '',
          shangpinguige: '',
          shangpinpinpai: '',
          shangjiashijian: '',
          shangpinjieshao: '',
          shangjiazhanghao: '',
          shangjiamingcheng: '',
          onelimittimes: Number('-1') ,
          alllimittimes: Number('-1') ,
          clicktime: '',
          clicknum: '',
          discussnum: '',
          price: '',
          storeupnum: '',
        },
        shangpinfenleiOptions: [],


        rules: {
          shangpintiaoma: [
          ],
          shangpinmingcheng: [
          ],
          shangpinfenlei: [
          ],
          shangpintupian: [
          ],
          shangpinguige: [
          ],
          shangpinpinpai: [
          ],
          shangjiashijian: [
          ],
          shangpinjieshao: [
          ],
          shangjiazhanghao: [
          ],
          shangjiamingcheng: [
          ],
          onelimittimes: [
            { validator: this.$validate.isIntNumer, trigger: 'blur' },
          ],
          alllimittimes: [
            { validator: this.$validate.isIntNumer, trigger: 'blur' },
          ],
          clicktime: [
          ],
          clicknum: [
            { validator: this.$validate.isIntNumer, trigger: 'blur' },
          ],
          discussnum: [
            { validator: this.$validate.isIntNumer, trigger: 'blur' },
          ],
          price: [
            { required: true, message: '价格不能为空', trigger: 'blur' },
            { validator: this.$validate.isNumber, trigger: 'blur' },
          ],
          storeupnum: [
            { validator: this.$validate.isIntNumer, trigger: 'blur' },
          ],
        },
		centerType: false,
      };
    },
    computed: {



    },
    components: {
    },
    created() {
		if(this.$route.query.centerType){
			this.centerType = true
		}
	  //this.bg();
      let type = this.$route.query.type ? this.$route.query.type : '';
      this.init(type);
      this.baseUrl = this.$config.baseUrl;
      this.ruleForm.shangjiashijian = this.getCurDate()
    },
    methods: {
      getMakeZero(s) {
          return s < 10 ? '0' + s : s;
      },
      // 下载
      download(file){
        window.open(`${file}`)
      },
      // 初始化
      init(type) {
        this.type = type;
        if(type=='cross'){
          var obj = JSON.parse(localStorage.getItem('crossObj'));
          for (var o in obj){
            if(o=='shangpintiaoma'){
              this.ruleForm.shangpintiaoma = obj[o];
              this.ro.shangpintiaoma = true;
              continue;
            }
            if(o=='shangpinmingcheng'){
              this.ruleForm.shangpinmingcheng = obj[o];
              this.ro.shangpinmingcheng = true;
              continue;
            }
            if(o=='shangpinfenlei'){
              this.ruleForm.shangpinfenlei = obj[o];
              this.ro.shangpinfenlei = true;
              continue;
            }
            if(o=='shangpintupian'){
              this.ruleForm.shangpintupian = obj[o].split(",")[0];
              this.ro.shangpintupian = true;
              continue;
            }
            if(o=='shangpinguige'){
              this.ruleForm.shangpinguige = obj[o];
              this.ro.shangpinguige = true;
              continue;
            }
            if(o=='shangpinpinpai'){
              this.ruleForm.shangpinpinpai = obj[o];
              this.ro.shangpinpinpai = true;
              continue;
            }
            if(o=='shangjiashijian'){
              this.ruleForm.shangjiashijian = obj[o];
              this.ro.shangjiashijian = true;
              continue;
            }
            if(o=='shangpinjieshao'){
              this.ruleForm.shangpinjieshao = obj[o];
              this.ro.shangpinjieshao = true;
              continue;
            }
            if(o=='shangjiazhanghao'){
              this.ruleForm.shangjiazhanghao = obj[o];
              this.ro.shangjiazhanghao = true;
              continue;
            }
            if(o=='shangjiamingcheng'){
              this.ruleForm.shangjiamingcheng = obj[o];
              this.ro.shangjiamingcheng = true;
              continue;
            }
            if(o=='onelimittimes'){
              this.ruleForm.onelimittimes = obj[o];
              this.ro.onelimittimes = true;
              continue;
            }
            if(o=='alllimittimes'){
              this.ruleForm.alllimittimes = obj[o];
              this.ro.alllimittimes = true;
              continue;
            }
            if(o=='clicktime'){
              this.ruleForm.clicktime = obj[o];
              this.ro.clicktime = true;
              continue;
            }
            if(o=='clicknum'){
              this.ruleForm.clicknum = obj[o];
              this.ro.clicknum = true;
              continue;
            }
            if(o=='discussnum'){
              this.ruleForm.discussnum = obj[o];
              this.ro.discussnum = true;
              continue;
            }
            if(o=='price'){
              this.ruleForm.price = obj[o];
              this.ro.price = true;
              continue;
            }
            if(o=='storeupnum'){
              this.ruleForm.storeupnum = obj[o];
              this.ro.storeupnum = true;
              continue;
            }
          }
        }else if(type=='edit'){
			this.info()
		}
        // 获取用户信息
        this.$http.get(this.userTableName + '/session', {emulateJSON: true}).then(res => {
          if (res.data.code == 0) {
            var json = res.data.data;
            if((json.shangjiazhanghao!=''&&json.shangjiazhanghao) || json.shangjiazhanghao==0){
                this.ruleForm.shangjiazhanghao = json.shangjiazhanghao;
				this.ro.shangjiazhanghao = true;
            }
            if((json.shangjiamingcheng!=''&&json.shangjiamingcheng) || json.shangjiamingcheng==0){
                this.ruleForm.shangjiamingcheng = json.shangjiamingcheng;
				this.ro.shangjiamingcheng = true;
            }
          }
        });
        this.$http.get('option/shangpinfenlei/shangpinfenlei', {emulateJSON: true}).then(res => {
          if (res.data.code == 0) {
            this.shangpinfenleiOptions = res.data.data;
          }
        });

		if (localStorage.getItem('raffleType') && localStorage.getItem('raffleType') != null) {
			localStorage.removeItem('raffleType')
			setTimeout(() => {
				this.onSubmit()
			}, 300)
		}
      },

    // 多级联动参数
      // 多级联动参数
      info() {
        this.$http.get(`shangpinxinxi/detail/${this.$route.query.id}`, {emulateJSON: true}).then(res => {
          if (res.data.code == 0) {
            this.ruleForm = res.data.data;
          }
        });
      },
      // 提交
      onSubmit() {
			if(this.ruleForm.shangpintiaoma){
				this.ruleForm.shangpintiaoma = String(this.ruleForm.shangpintiaoma)
			}
			if(this.ruleForm.price<0){
				this.$message.error("价格不能输入负数");
				return
			}
			if(this.ruleForm.alllimittimes<0){
				this.$message.error("库存不能输入负数");
				return
			}
			if(this.ruleForm.onelimittimes<0){
				this.$message.error("单次购买不能输入负数");
				return
			}
			//更新跨表属性
			var crossuserid;
			var crossrefid;
			var crossoptnum;
			this.$refs["ruleForm"].validate(valid => {
				if(valid) {
					if(this.type=='cross'){
						var statusColumnName = localStorage.getItem('statusColumnName');
						var statusColumnValue = localStorage.getItem('statusColumnValue');
						if(statusColumnName && statusColumnName!='') {
							var obj = JSON.parse(localStorage.getItem('crossObj'));
							if(!statusColumnName.startsWith("[")) {
								for (var o in obj){
									if(o==statusColumnName){
										obj[o] = statusColumnValue;
									}
								}
								var table = localStorage.getItem('crossTable');
								this.$http.post(table+'/update', obj).then(res => {});
							} else {
								crossuserid=Number(localStorage.getItem('frontUserid'));
								crossrefid=obj['id'];
								crossoptnum=localStorage.getItem('statusColumnName');
								crossoptnum=crossoptnum.replace(/\[/,"").replace(/\]/,"");
							}
						}
					}
					if(crossrefid && crossuserid) {
						this.ruleForm.crossuserid=crossuserid;
						this.ruleForm.crossrefid=crossrefid;
						var params = {
							page: 1,
							limit: 10,
							crossuserid:crossuserid,
							crossrefid:crossrefid,
						}
						this.$http.get('shangpinxinxi/list', {
							params: params
						}).then(res => {
							if(res.data.data.total>=crossoptnum) {
								this.$message({
									message: localStorage.getItem('tips'),
									type: 'error',
									duration: 1500,
								});
								return false;
							} else {
								// 跨表计算


								this.$http.post(`shangpinxinxi/${this.ruleForm.id?'update':this.centerType?'save':'add'}`, this.ruleForm).then(res => {
									if (res.data.code == 0) {
										this.$message({
											message: '操作成功',
											type: 'success',
											duration: 1500,
											onClose: () => {
												this.$router.go(-1);
											}
										});
									} else {
										this.$message({
											message: res.data.msg,
											type: 'error',
											duration: 1500
										});
									}
								});
							}
						});
					} else {


						this.$http.post(`shangpinxinxi/${this.ruleForm.id?'update':this.centerType?'save':'add'}`, this.ruleForm).then(res => {
							if (res.data.code == 0) {
								this.$message({
									message: '操作成功',
									type: 'success',
									duration: 1500,
									onClose: () => {
										this.$router.go(-1);
									}
								});
							} else {
								this.$message({
									message: res.data.msg,
									type: 'error',
									duration: 1500
								});
							}
						});
					}
				}
			});
		},
		// 获取uuid
		getUUID () {
			return new Date().getTime();
		},
		// 返回
		back() {
			this.$router.go(-1);
		},
      shangpintupianUploadChange(fileUrls) {
          this.ruleForm.shangpintupian = fileUrls.replace(new RegExp(this.$config.baseUrl,"g"),"");
      },
    }
  };
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
	.el-date-editor.el-input {
		width: auto;
	}
	
	.add-update-preview .el-form-item /deep/ .el-form-item__label {
	  padding: 0 10px 0 0;
	  color: #000;
	  font-weight: 500;
	  width: 80px;
	  font-size: 14px;
	  line-height: 40px;
	  text-align: right;
	}
	
	.add-update-preview .el-form-item /deep/ .el-form-item__content {
	  margin-left: 80px;
	}
	
	.add-update-preview .el-input /deep/ .el-input__inner {
	  border: 1px solid #E2E3E5;
	  border-radius: 0;
	  padding: 0 12px;
	  box-shadow: none;
	  outline: none;
	  color: #000;
	  width: 400px;
	  font-size: 14px;
	  height: 40px;
	}
	.add-update-preview .el-input-number /deep/ .el-input__inner {
		text-align: left;
	  border: 1px solid #E2E3E5;
	  border-radius: 0;
	  padding: 0 12px;
	  box-shadow: none;
	  outline: none;
	  color: #000;
	  width: 400px;
	  font-size: 14px;
	  height: 40px;
	}
	.add-update-preview .el-input-number /deep/ .el-input-number__decrease {
		display: none;
	}
	.add-update-preview .el-input-number /deep/ .el-input-number__increase {
		display: none;
	}
	
	.add-update-preview .el-select /deep/ .el-input__inner {
	  border: 1px solid #E2E3E5;
	  border-radius: 0;
	  padding: 0 10px;
	  box-shadow: none;
	  outline: none;
	  color: #000;
	  width: 400px;
	  font-size: 14px;
	  height: 40px;
	}
	
	.add-update-preview .el-date-editor /deep/ .el-input__inner {
	  border: 1px solid #E2E3E5;
	  border-radius: 0;
	  padding: 0 10px 0 30px;
	  box-shadow: none;
	  outline: none;
	  color: #000;
	  width: 400px;
	  font-size: 14px;
	  height: 40px;
	}
	
	.add-update-preview /deep/ .el-upload--picture-card {
		background: transparent;
		border: 0;
		border-radius: 0;
		width: auto;
		height: auto;
		line-height: initial;
		vertical-align: middle;
	}
	
	.add-update-preview /deep/ .upload .upload-img {
	  border: 1px solid #E2E3E5;
	  cursor: pointer;
	  border-radius: 6px;
	  color: #000;
	  width: 200px;
	  font-size: 32px;
	  line-height: 60px;
	  text-align: center;
	  height: 60px;
	}
	
	.add-update-preview /deep/ .el-upload-list .el-upload-list__item {
	  border: 1px solid #E2E3E5;
	  cursor: pointer;
	  border-radius: 6px;
	  color: #000;
	  width: 200px;
	  font-size: 32px;
	  line-height: 60px;
	  text-align: center;
	  height: 60px;
	}
	
	.add-update-preview /deep/ .el-upload .el-icon-plus {
	  border: 1px solid #E2E3E5;
	  cursor: pointer;
	  border-radius: 6px;
	  color: #000;
	  width: 200px;
	  font-size: 32px;
	  line-height: 60px;
	  text-align: center;
	  height: 60px;
	}
	
	.add-update-preview .el-textarea /deep/ .el-textarea__inner {
	  border: 1px solid #E2E3E5;
	  border-radius: 0;
	  padding: 12px;
	  box-shadow: none;
	  outline: none;
	  color: #000;
	  width: 400px;
	  font-size: 14px;
	  height: 120px;
	}
</style>
