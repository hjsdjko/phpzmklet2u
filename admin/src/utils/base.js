const base = {
    get() {
        return {
            url : "http://localhost:8080/phpzmklet2u/",
            name: "phpzmklet2u",
            // 退出到首页链接
            indexUrl: 'http://localhost:8080/phpzmklet2u/front/dist/index.html'
        };
    },
    getProjectName(){
        return {
            projectName: "校园Flea Market售货平台"
        } 
    }
}
export default base
