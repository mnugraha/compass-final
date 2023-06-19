import{L as lt}from"./User-256fc148.js";import{n as dt,$ as rt,H as ct,L as ut,a as N,Y as ht,b as I,o as a,c as l,d as L,w as D,e as t,t as d,j as u,F as j,i as $,f as h,l as c,K as tt,k as v}from"./app-7aa65b10.js";import{a as x}from"./axios-4a70c6fc.js";import{S as _t}from"./sweetalert2.all-780e3ebe.js";import{_ as mt}from"./_plugin-vue_export-helper-c27b6911.js";/*! vue-countdown v2.1.1 | (c) 2018-present Chen Fengyuan | MIT */const p=1e3,M=60*p,E=60*M,et=24*E,st="abort",it="end",ot="progress",nt="start",at="visibilitychange";var bt=dt({name:"VueCountdown",props:{autoStart:{type:Boolean,default:!0},emitEvents:{type:Boolean,default:!0},interval:{type:Number,default:1e3,validator:i=>i>=0},now:{type:Function,default:()=>Date.now()},tag:{type:String,default:"span"},time:{type:Number,default:0,validator:i=>i>=0},transform:{type:Function,default:i=>i}},emits:[st,it,ot,nt],data(){return{counting:!1,endTime:0,totalMilliseconds:0,requestId:0}},computed:{days(){return Math.floor(this.totalMilliseconds/et)},hours(){return Math.floor(this.totalMilliseconds%et/E)},minutes(){return Math.floor(this.totalMilliseconds%E/M)},seconds(){return Math.floor(this.totalMilliseconds%M/p)},milliseconds(){return Math.floor(this.totalMilliseconds%p)},totalDays(){return this.days},totalHours(){return Math.floor(this.totalMilliseconds/E)},totalMinutes(){return Math.floor(this.totalMilliseconds/M)},totalSeconds(){return Math.floor(this.totalMilliseconds/p)}},watch:{$props:{deep:!0,immediate:!0,handler(){this.totalMilliseconds=this.time,this.endTime=this.now()+this.time,this.autoStart&&this.start()}}},mounted(){document.addEventListener(at,this.handleVisibilityChange)},beforeUnmount(){document.removeEventListener(at,this.handleVisibilityChange),this.pause()},methods:{start(){this.counting||(this.counting=!0,this.emitEvents&&this.$emit(nt),document.visibilityState==="visible"&&this.continue())},continue(){if(!this.counting)return;const i=Math.min(this.totalMilliseconds,this.interval);if(i>0){let n,e;const s=_=>{n||(n=_),e||(e=_);const f=_-n;f>=i||f+(_-e)/2>=i?this.progress():this.requestId=requestAnimationFrame(s),e=_};this.requestId=requestAnimationFrame(s)}else this.end()},pause(){cancelAnimationFrame(this.requestId)},progress(){this.counting&&(this.update(),this.emitEvents&&this.totalMilliseconds>0&&this.$emit(ot,{days:this.days,hours:this.hours,minutes:this.minutes,seconds:this.seconds,milliseconds:this.milliseconds,totalDays:this.totalDays,totalHours:this.totalHours,totalMinutes:this.totalMinutes,totalSeconds:this.totalSeconds,totalMilliseconds:this.totalMilliseconds}),this.continue())},abort(){this.counting&&(this.pause(),this.counting=!1,this.emitEvents&&this.$emit(st))},end(){this.counting&&(this.pause(),this.totalMilliseconds=0,this.counting=!1,this.emitEvents&&this.$emit(it))},update(){this.counting&&(this.totalMilliseconds=Math.max(0,this.endTime-this.now()))},restart(){this.pause(),this.totalMilliseconds=this.time,this.endTime=this.now()+this.time,this.counting=!1,this.start()},handleVisibilityChange(){switch(document.visibilityState){case"visible":this.update(),this.continue();break;case"hidden":this.pause();break}}},render(){return rt(this.tag,this.$slots.default?[this.$slots.default(this.transform({days:this.days,hours:this.hours,minutes:this.minutes,seconds:this.seconds,milliseconds:this.milliseconds,totalDays:this.totalDays,totalHours:this.totalHours,totalMinutes:this.totalMinutes,totalSeconds:this.totalSeconds,totalMilliseconds:this.totalMilliseconds}))]:void 0)}});const ft={layout:lt,components:{Head:ct,Link:ut,VueCountdown:bt},props:{id:Number,page:Number,exam_group:Object,all_questions:Array,question_answered:Number,question_active:Object,answer_order:Array,duration:Object},setup(i){let n=["A","B","C","D","E"];const e=N(i.duration.duration);let s;s=setInterval(()=>{e.value-=5e3,x.put(`/exam-duration/update/${i.duration.id}`,{duration:e.value})},5e3),ht(()=>{clearInterval(s)});const f=()=>{x.put(`/exam-duration/update/${i.duration.id}`,{duration:e.value}),v.Inertia.get(`/exam/${i.id}/${i.page-1}`)},S=()=>{x.put(`/exam-duration/update/${i.duration.id}`,{duration:e.value}),v.Inertia.get(`/exam/${i.id}/${i.page+1}`)},C=b=>{x.put(`/exam-duration/update/${i.duration.id}`,{duration:e.value}),v.Inertia.get(`/exam/${i.id}/${b+1}`)},q=(b,k,w)=>{v.Inertia.post("/exam-answer",{exam_id:b,exam_session_id:i.exam_group.exam_session.id,question_id:k,answer:w,duration:e.value})},y=N(!1),g=N(!1);return{options:n,duration:e,prevPage:f,nextPage:S,clickQuestion:C,submitAnswer:q,showModalEndExam:y,showModalEndTimeExam:g,endExam:()=>{v.Inertia.post("/exam-end",{exam_group_id:i.exam_group.id,exam_id:i.exam_group.exam.id,exam_session_id:i.exam_group.exam_session.id}),_t.fire({title:"Success!",text:"Ujian Selesai!.",icon:"success",showConfirmButton:!1,timer:4e3})}}}},vt={class:"row mb-5"},yt={class:"col-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center"},gt=t("i",{class:"fa fa-long-arrow-alt-left me-2"},null,-1),kt=c(" Kembali "),wt={class:"col-md-12 mb-2"},xt={class:"card border-0 shadow"},pt={class:"card-body"},Mt={class:"table-responsive"},Et={class:"table table-centered table-nowrap mb-0 rounded table-borderless"},St=t("td",{class:"fw-bold ps-0 py-1",style:{width:"5%"}}," Nama Lengkap ",-1),Ct={class:"py-1"},qt=t("td",{class:"fw-bold ps-0 py-1",style:{width:"5%"}}," Durasi ",-1),Tt={class:"py-1"},Nt=t("td",{class:"fw-bold ps-0 py-1",style:{width:"5%"}}," Total Soal ",-1),It={class:"py-1"},Lt={class:"col-md-8 my-2"},Dt={class:"card border-0 shadow mb-3 p-0",style:{"background-color":"#fbfafb"}},jt={class:"card-header border-0"},Vt={class:"d-flex justify-content-between"},Ht={class:"mb-0"},At=c(" Soal No. "),Ot={class:"text-white bg-info px-2",style:{"border-radius":"3px"}},Bt={class:"fw-bold"},Ft={class:"badge bg-info p-2",style:{"border-radius":"3px"}},Pt=t("i",{class:"fa fa-clock"},null,-1),Ut={class:"card-body pt-0"},Yt={class:"bg-white p-3 border rounded-1"},Rt={key:0},Kt={key:0,controls:""},Qt=["src"],zt=["innerHTML"],Gt=t("hr",null,null,-1),Wt={width:"50",style:{padding:"10px"}},Jt={key:0,class:"btn btn-info btn-sm w-100 shdaow"},Xt=["onClick"],Zt={style:{padding:"10px"}},$t=["innerHTML"],te={key:1},ee=t("div",{class:"alert alert-danger border-0 shadow"},[t("i",{class:"fa fa-exclamation-triangle"}),c(" Soal Tidak Ditemukan!. ")],-1),se=[ee],ie={class:"d-flex justify-content-between"},oe={class:"text-start"},ne=t("i",{class:"fa fa-arrow-left",style:{"font-size":"12px","padding-right":"5px"}},null,-1),ae=c(" Back "),le=[ne,ae],de={class:"text-end"},re=c(" Next "),ce=t("i",{class:"fa fa-arrow-right",style:{"font-size":"12px","padding-left":"5px"}},null,-1),ue=[re,ce],he={class:"col-md-4 my-2"},_e={class:"card border-0 shadow mb-3"},me={class:"card-header text-center"},be={class:"badge bg-info p-2"},fe=t("i",{class:"fa fa-check-circle"},null,-1),ve={class:"badge bg-success p-2 m-2"},ye=t("i",{class:"fa fa-book"},null,-1),ge={class:"card-body",style:{"overflow-y":"auto"}},ke={width:"20%",style:{width:"20%",float:"left"}},we={style:{padding:"5px"}},xe=["onClick"],pe=["onClick"],Me=["onClick"],Ee={class:"card p-4"},Se={class:"modal-dialog"},Ce={class:"modal-content"},qe=t("div",{class:"modal-header"},[t("h5",{class:"modal-title"},"Akhiri Ujian ?")],-1),Te=t("div",{class:"modal-body"}," Setelah mengakhiri ujian, Anda tidak dapat kembali ke ujian ini lagi. Yakin akan mengakhiri ujian? ",-1),Ne={class:"modal-footer"},Ie={class:"modal-dialog"},Le={class:"modal-content"},De=t("div",{class:"modal-header"},[t("h5",{class:"modal-title"},"Waktu Habis !")],-1),je=t("div",{class:"modal-body"},[c(" Waktu ujian sudah berakhir!. Klik "),t("strong",{class:"fw-bold"},"Ya"),c(" untuk mengakhiri ujian. ")],-1),Ve={class:"modal-footer"};function He(i,n,e,s,_,f){var y,g,T,b,k,w,V,H,A,O,B,F,P,U,Y,R,K,Q;const S=I("Head"),C=I("Link"),q=I("VueCountdown");return a(),l(j,null,[L(S,null,{default:D(()=>[t("title",null,"Ujian Dengan Nomor Soal : "+d(e.page),1)]),_:1}),t("div",vt,[t("div",yt,[L(C,{href:"/exam",class:"btn btn-md btn-primary border-0 shadow mb-3",type:"button"},{default:D(()=>[gt,kt]),_:1})]),t("div",wt,[t("div",xt,[t("div",pt,[t("h5",null,d((g=(y=e.exam_group)==null?void 0:y.exam)==null?void 0:g.title)+" - "+d((b=(T=e.exam_group)==null?void 0:T.exam_session)==null?void 0:b.title),1),t("div",Mt,[t("table",Et,[t("thead",null,[t("tr",null,[St,t("td",Ct," : "+d(i.$page.props.auth.user.name),1)]),t("tr",null,[qt,t("td",Tt," : "+d((w=(k=e.exam_group)==null?void 0:k.exam)==null?void 0:w.duration)+" Menit ",1)]),t("tr",null,[Nt,t("td",It," : "+d((A=(H=(V=e.exam_group)==null?void 0:V.exam)==null?void 0:H.questions)==null?void 0:A.length),1)])])])])])])]),t("div",Lt,[t("div",Dt,[t("div",jt,[t("div",Vt,[t("div",null,[t("h5",Ht,[At,t("span",Ot,[t("strong",Bt,d(e.page),1)])])]),t("div",null,[L(q,{time:s.duration,onEnd:n[0]||(n[0]=o=>s.showModalEndTimeExam=!0)},{default:D(({hours:o,minutes:r,seconds:m})=>[t("span",Ft,[Pt,c(" | "+d(o)+" : "+d(r)+" : "+d(m),1)])]),_:1},8,["time"])])])]),t("div",Ut,[t("div",Yt,[e.question_active!==null?(a(),l("div",Rt,[t("div",null,[(B=(O=e.question_active)==null?void 0:O.question)!=null&&B.question_file?(a(),l("audio",Kt,[t("source",{src:`/storage/exams/question/${(P=(F=e.question_active)==null?void 0:F.question)==null?void 0:P.question_file}`,type:"audio/mpeg"},null,8,Qt)])):u("",!0),(Y=(U=e.question_active)==null?void 0:U.question)!=null&&Y.question?(a(),l("p",{key:1,innerHTML:(K=(R=e.question_active)==null?void 0:R.question)==null?void 0:K.question},null,8,zt)):u("",!0),Gt]),t("table",null,[t("tbody",null,[(a(!0),l(j,null,$(e.answer_order,(o,r)=>{var m,z;return a(),l("tr",{key:r},[t("td",Wt,[o==((m=e.question_active)==null?void 0:m.answer)?(a(),l("button",Jt,d(s.options[r]),1)):(a(),l("button",{key:1,onClick:h(Ae=>{var G,W,J,X,Z;return s.submitAnswer((J=(W=(G=e.question_active)==null?void 0:G.question)==null?void 0:W.exam)==null?void 0:J.id,(Z=(X=e.question_active)==null?void 0:X.question)==null?void 0:Z.id,o)},["prevent"]),class:"btn btn-outline-primary btn-sm w-100 shdaow"},d(s.options[r]),9,Xt))]),t("td",Zt,[t("p",{innerHTML:(z=e.question_active)==null?void 0:z.question["option_"+o]},null,8,$t)])])}),128))])])])):(a(),l("div",te,se))])])]),t("div",ie,[t("div",oe,[e.page>1?(a(),l("button",{key:0,onClick:n[1]||(n[1]=h((...o)=>s.prevPage&&s.prevPage(...o),["prevent"])),type:"button",class:"btn btn-info btn-sm btn-block mb-2"},le)):u("",!0)]),t("div",de,[e.page<Object.keys(e.all_questions).length?(a(),l("button",{key:0,onClick:n[2]||(n[2]=h((...o)=>s.nextPage&&s.nextPage(...o),["prevent"])),type:"button",class:"btn btn-info btn-sm"},ue)):u("",!0)])])]),t("div",he,[t("div",_e,[t("div",me,[t("div",be,[fe,c(" "+d(e.question_answered)+" dikerjakan ",1)]),t("div",ve,[ye,c(" "+d((Q=e.all_questions)==null?void 0:Q.length)+" Total Soal ",1)])]),t("div",ge,[(a(!0),l(j,null,$(e.all_questions,(o,r)=>(a(),l("div",{key:r},[t("div",ke,[t("div",we,[r+1==e.page?(a(),l("button",{key:0,onClick:h(m=>s.clickQuestion(r),["prevent"]),class:"btn btn-gray-400 btn-sm w-100"},d(r+1),9,xe)):u("",!0),r+1!=e.page&&o.answer==0?(a(),l("button",{key:1,onClick:h(m=>s.clickQuestion(r),["prevent"]),class:"btn btn-outline-primary btn-sm w-100"},d(r+1),9,pe)):u("",!0),r+1!=e.page&&(o==null?void 0:o.answer)!=0?(a(),l("button",{key:2,onClick:h(m=>s.clickQuestion(r),["prevent"]),class:"btn btn-info btn-sm w-100"},d(r+1),9,Me)):u("",!0)])])]))),128))])]),t("div",Ee,[t("button",{onClick:n[3]||(n[3]=o=>s.showModalEndExam=!0),class:"btn btn-info btn-md border-0 shadow w-100"}," Kirim Jawaban ")])])]),s.showModalEndExam?(a(),l("div",{key:0,class:tt(["modal fade",{show:s.showModalEndExam}]),tabindex:"-1","aria-hidden":"true",style:{display:"block"},role:"dialog"},[t("div",Se,[t("div",Ce,[qe,Te,t("div",Ne,[t("button",{onClick:n[4]||(n[4]=h((...o)=>s.endExam&&s.endExam(...o),["prevent"])),type:"button",class:"btn btn-primary"}," Ya, Akhiri "),t("button",{onClick:n[5]||(n[5]=h(o=>s.showModalEndExam=!1,["prevent"])),type:"button",class:"btn btn-secondary"}," Tutup ")])])])],2)):u("",!0),s.showModalEndTimeExam?(a(),l("div",{key:1,class:tt(["modal fade",{show:s.showModalEndTimeExam}]),"data-bs-backdrop":"static","data-bs-keyboard":"false",tabindex:"-1","aria-hidden":"true",style:{display:"block"},role:"dialog"},[t("div",Ie,[t("div",Le,[De,je,t("div",Ve,[t("button",{onClick:n[6]||(n[6]=h((...o)=>s.endExam&&s.endExam(...o),["prevent"])),type:"button",class:"btn btn-primary"}," Ya ")])])])],2)):u("",!0)],64)}const Ye=mt(ft,[["render",He]]);export{Ye as default};