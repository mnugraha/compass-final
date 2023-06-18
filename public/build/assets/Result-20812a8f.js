import{L as q}from"./User-cdf85a4b.js";import{P as tt}from"./Pagination-ceb1ea9d.js";import{H as lt,L as et,b as r,o as a,c as s,d as i,w as I,e as t,F as Q,i as at,t as o,j as n,l as _,K as c}from"./app-2fd99817.js";import{_ as st}from"./_plugin-vue_export-helper-c27b6911.js";const ot={layout:q,components:{Head:lt,Link:et,Pagination:tt},props:{exam_group:Object,grade:Object,all_questions:Object},methods:{generatePDF(h){window.open(`/grade/print-pdf/${h}`,"_blank")}}},dt=t("title",null,"Hasil Ujian",-1),nt={class:"row"},ct={class:"col-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center"},_t=t("i",{class:"fa fa-long-arrow-alt-left me-2"},null,-1),rt=_(" Kembali "),it={class:"col-lg-7 col-md-4 col-12 mb-3"},ht={class:"card border-0 shadow"},mt={class:"card-body"},bt=t("h5",null,[t("i",{class:"fa fa-question-circle"}),_(" Soal Ujian")],-1),wt=t("hr",null,null,-1),ft={class:"table-responsive mt-3"},gt={class:"table table-bordered table-centered table-nowrap mb-0 rounded"},xt=t("thead",{class:"thead-dark"},[t("tr",{class:"border-0"},[t("th",{class:"border-0 rounded-start",style:{width:"5%"}}," No. "),t("th",{class:"border-0"},"Soal")])],-1),yt=t("div",{class:"mt-2"},null,-1),ut={class:"fw-bold text-center"},kt=["innerHTML"],Lt={key:1,controls:""},pt=["src"],Ht=t("hr",null,null,-1),vt={type:"A"},Mt=["innerHTML"],Tt=["innerHTML"],jt=["innerHTML"],St=["innerHTML"],Nt=["innerHTML"],Pt={class:"alert alert-gray-800",role:"alert"},Dt={key:0,class:"text-success fw-bold"},Bt={key:1,class:"text-danger fw-bold"},Ct={class:"col-lg-5 col-md-8 col-12"},Ft={class:"card border-0 shadow mb-4"},Ut={class:"card-body"},Vt=t("h5",null,[t("i",{class:"fa fa-check-circle"}),_(" Hasil Ujian")],-1),Yt=t("hr",null,null,-1),Jt={class:"table-responsive"},Ot={class:"table table-bordered table-centered table-nowrap mb-0 rounded"},Kt=t("td",{style:{width:"25%"},class:"fw-bold"}," Nama Lengkap ",-1),zt={class:"white-space"},At=t("td",{style:{width:"25%"},class:"fw-bold"}," Ujian ",-1),Et={class:"white-space"},Rt=t("td",{style:{width:"25%"},class:"fw-bold"}," Mulai Mengerjakan ",-1),Gt=t("td",{style:{width:"25%"},class:"fw-bold"}," Selesai Mengerjakan ",-1),It=t("td",{style:{width:"25%"},class:"fw-bold"}," Jumlah Soal ",-1),Qt={key:0},Wt=t("td",{style:{width:"25%"},class:"fw-bold"}," Jumlah Benar ",-1),Xt={key:1},Zt=t("td",{style:{width:"25%"},class:"fw-bold"}," Jumlah Salah ",-1),$t={key:2},qt=t("td",{style:{width:"25%"},class:"fw-bold"}," Nilai ",-1),tl=t("td",null,"Download",-1),ll=t("i",{class:"fa fa-file-pdf me-2"},null,-1),el=_(" Download PDF "),al=[ll,el];function sl(h,m,e,ol,dl,W){var b,w,f,g,x,y,u,k,L,p,H,v,M,T,j,S,N,P,D,B,C,F;const X=r("Head"),Z=r("Link"),$=r("Pagination");return a(),s(Q,null,[i(X,null,{default:I(()=>[dt]),_:1}),t("div",nt,[t("div",ct,[i(Z,{href:"/exam",class:"btn btn-md btn-primary border-0 shadow mb-3",type:"button"},{default:I(()=>[_t,rt]),_:1})]),t("div",it,[t("div",ht,[t("div",mt,[bt,wt,t("div",ft,[t("table",gt,[xt,yt,t("tbody",null,[(a(!0),s(Q,null,at(e.all_questions.data,(l,d)=>{var U,V,Y,J,O,K,z,A,E,R,G;return a(),s("tr",{key:d},[t("td",ut,o(++d+(((U=e.all_questions)==null?void 0:U.current_page)-1)*((V=e.all_questions)==null?void 0:V.per_page)),1),t("td",null,[(Y=l==null?void 0:l.question)!=null&&Y.question?(a(),s("div",{key:0,class:"fw-bold",innerHTML:(J=l==null?void 0:l.question)==null?void 0:J.question},null,8,kt)):n("",!0),(O=l==null?void 0:l.question)!=null&&O.question_file?(a(),s("audio",Lt,[t("source",{src:`/storage/exams/question/${(K=l==null?void 0:l.question)==null?void 0:K.question_file}`,type:"audio/mpeg"},null,8,pt)])):n("",!0),Ht,t("ol",vt,[t("li",{innerHTML:(z=l==null?void 0:l.question)==null?void 0:z.option_1,class:c({"text-info fw-bold":(l==null?void 0:l.answer)=="1"})},null,10,Mt),t("li",{innerHTML:(A=l==null?void 0:l.question)==null?void 0:A.option_2,class:c({"text-info fw-bold":(l==null?void 0:l.answer)=="2"})},null,10,Tt),t("li",{innerHTML:(E=l==null?void 0:l.question)==null?void 0:E.option_3,class:c({"text-info fw-bold":(l==null?void 0:l.answer)=="3"})},null,10,jt),t("li",{innerHTML:(R=l==null?void 0:l.question)==null?void 0:R.option_4,class:c({"text-info fw-bold":(l==null?void 0:l.answer)=="4"})},null,10,St),t("li",{innerHTML:(G=l==null?void 0:l.question)==null?void 0:G.option_5,class:c({"text-info fw-bold":(l==null?void 0:l.answer)=="5"})},null,10,Nt)]),t("div",Pt,[(l==null?void 0:l.is_correct)==="Y"?(a(),s("p",Dt," Benar ")):(a(),s("p",Bt," Salah "))])])])}),128))])])]),i($,{links:e.all_questions.links,show:(b=e.all_questions)==null?void 0:b.per_page,total:(w=e.all_questions)==null?void 0:w.total,align:"end"},null,8,["links","show","total"])])])]),t("div",Ct,[t("div",Ft,[t("div",Ut,[Vt,Yt,t("div",Jt,[t("table",Ot,[t("tbody",null,[t("tr",null,[Kt,t("td",zt,o((g=(f=e.exam_group)==null?void 0:f.user)==null?void 0:g.name),1)]),t("tr",null,[At,t("td",Et,o((y=(x=e.exam_group)==null?void 0:x.exam)==null?void 0:y.title)+" - "+o((k=(u=e.exam_group)==null?void 0:u.exam_session)==null?void 0:k.title),1)]),t("tr",null,[Rt,t("td",null,o((L=e.grade)==null?void 0:L.start_time),1)]),t("tr",null,[Gt,t("td",null,o((p=e.grade)==null?void 0:p.end_time),1)]),t("tr",null,[It,t("td",null,o((M=(v=(H=e.exam_group)==null?void 0:H.exam)==null?void 0:v.questions)==null?void 0:M.length),1)]),((j=(T=e.exam_group)==null?void 0:T.exam)==null?void 0:j.show_answer)=="Y"?(a(),s("tr",Qt,[Wt,t("td",null,o((S=e.grade)==null?void 0:S.total_correct),1)])):n("",!0),((P=(N=e.exam_group)==null?void 0:N.exam)==null?void 0:P.show_answer)=="Y"?(a(),s("tr",Xt,[Zt,t("td",null,o((D=e.grade)==null?void 0:D.total_incorrect),1)])):n("",!0),((C=(B=e.exam_group)==null?void 0:B.exam)==null?void 0:C.show_answer)=="Y"?(a(),s("tr",$t,[qt,t("td",null,o((F=e.grade)==null?void 0:F.grade),1)])):n("",!0),t("tr",null,[tl,t("td",null,[t("a",{onClick:m[0]||(m[0]=l=>{var d;return W.generatePDF((d=e.grade)==null?void 0:d.id)}),class:"btn btn-info mb-0"},al)])])])])])])])])])],64)}const il=st(ot,[["render",sl]]);export{il as default};