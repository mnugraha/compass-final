import{L as $}from"./Admin-2b5121e9.js";import{P as q}from"./Pagination-f2932da7.js";import{H as tt,L as et,a as at,b as w,o as _,c as m,d as r,w as h,e as t,t as s,f as Q,g as st,v as lt,F as W,i as nt,k as X,l as f,j as Z,K as b}from"./app-d479d588.js";import{S as o}from"./sweetalert2.all-d504ecd0.js";import{_ as ot}from"./_plugin-vue_export-helper-c27b6911.js";const dt={layout:$,components:{Head:tt,Link:et,Pagination:q},props:{errors:Object,exam:Object},setup(x){const n=at(new URL(document.location).searchParams.get("q"));return{destroy:(p,v)=>{o.fire({title:"Apakah Anda yakin?",text:"Anda tidak akan dapat mengembalikan ini!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then(u=>{u.isConfirmed&&X.Inertia.delete(`/admin/exams/${p}/questions/${v}/destroy`,{onSuccess:()=>{o.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:c=>{c.addEventListener("mouseenter",o.stopTimer),c.addEventListener("mouseleave",o.resumeTimer)}}).fire({icon:"success",title:"Data berhasil dihapus."})},onError:l=>{l.message&&o.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:i=>{i.addEventListener("mouseenter",o.stopTimer),i.addEventListener("mouseleave",o.resumeTimer)}}).fire({icon:"error",title:l.message||"Data gagal dihapus."})}})})},search:n,handleSearch:()=>{X.Inertia.get(`/admin/exams/${x.exam.id}`,{q:n.value})}}}},rt=t("title",null,"Detail Ujian",-1),ct={class:"container-fluid mb-5 mt-5"},it={class:"row"},_t={class:"col-md-12"},mt=t("i",{class:"fa fa-long-arrow-alt-left me-2"},null,-1),ht=f(" Kembali"),bt={class:"card border-0 shadow mb-4"},ft={class:"card-body"},ut=t("h5",null,[t("i",{class:"fa fa-edit"}),f(" Detail Ujian")],-1),wt=t("hr",null,null,-1),xt={class:"table-responsive"},pt={class:"table table-bordered table-centered table-nowrap mb-0 rounded"},vt=t("td",{style:{width:"30%"},class:"fw-bold"}," Nama Ujian ",-1),kt=t("td",{class:"fw-bold"},"Function",-1),gt=t("td",{class:"fw-bold"},"Level",-1),yt=t("td",{class:"fw-bold"},"Acak Soal",-1),Lt=t("td",{class:"fw-bold"},"Acak Jawaban",-1),Tt=t("td",{class:"fw-bold"},"Tampilkan Hasil",-1),Ht=t("td",{class:"fw-bold"},"Jumlah Soal",-1),Mt=t("td",{class:"fw-bold"},"Durasi (Menit)",-1),St={class:"card border-0 shadow"},Ct={class:"card-body"},Bt=t("h5",null,[t("i",{class:"fa fa-question-circle"}),f(" Soal Ujian ")],-1),At=t("hr",null,null,-1),jt=t("i",{class:"fa fa-plus-circle"},null,-1),Dt=f(" Tambah"),Pt=t("i",{class:"fa fa-file-excel"},null,-1),Et=f(" Import"),Nt={class:"row"},Ut={class:"col-md-6 col-12 mt-3"},Vt={class:"input-group"},Ot=t("span",{class:"input-group-text"},[t("i",{class:"fa fa-search"})],-1),Ft={class:"table-responsive mt-3"},It={class:"table table-bordered table-centered table-nowrap mb-0 rounded"},Jt=t("thead",{class:"thead-dark"},[t("tr",{class:"border-0"},[t("th",{class:"border-0 rounded-start",style:{width:"5%"}}," No. "),t("th",{class:"border-0"},"Soal"),t("th",{class:"border-0 rounded-end",style:{width:"15%"}}," Aksi ")])],-1),Kt=t("div",{class:"mt-2"},null,-1),zt={class:"fw-bold text-center"},Rt=["innerHTML"],Yt={key:1,controls:""},Gt=["src"],Qt=t("hr",null,null,-1),Wt={type:"A"},Xt=["innerHTML"],Zt=["innerHTML"],$t=["innerHTML"],qt=["innerHTML"],te=["innerHTML"],ee={class:"text-center"},ae=t("i",{class:"fa fa-pencil-alt"},null,-1),se=["onClick"],le=t("i",{class:"fa fa-trash"},null,-1),ne=[le];function oe(x,n,a,d,p,v){var i,k,g,y,L,T,H,M,S,C,B,A,j,D,P,E,N,U,V,O,F;const u=w("Head"),l=w("Link"),c=w("Pagination");return _(),m(W,null,[r(u,null,{default:h(()=>[rt]),_:1}),t("div",ct,[t("div",it,[t("div",_t,[r(l,{href:"/admin/exams",class:"btn btn-md btn-primary border-0 shadow mb-3",type:"button"},{default:h(()=>[mt,ht]),_:1}),t("div",bt,[t("div",ft,[ut,wt,t("div",xt,[t("table",pt,[t("tbody",null,[t("tr",null,[vt,t("td",null,s((i=a.exam)==null?void 0:i.title),1)]),t("tr",null,[kt,t("td",null,s((g=(k=a.exam)==null?void 0:k.peran)==null?void 0:g.nm_peran),1)]),t("tr",null,[gt,t("td",null,s((L=(y=a.exam)==null?void 0:y.level)==null?void 0:L.level),1)]),t("tr",null,[yt,t("td",null,s((T=a.exam)==null?void 0:T.random_question),1)]),t("tr",null,[Lt,t("td",null,s((H=a.exam)==null?void 0:H.random_answer),1)]),t("tr",null,[Tt,t("td",null,s((M=a.exam)==null?void 0:M.show_answer),1)]),t("tr",null,[Ht,t("td",null,s((B=(C=(S=a.exam)==null?void 0:S.questions)==null?void 0:C.data)==null?void 0:B.length),1)]),t("tr",null,[Mt,t("td",null,s((A=a.exam)==null?void 0:A.duration)+" Menit",1)])])])])])]),t("div",St,[t("div",Ct,[Bt,At,r(l,{href:`/admin/exams/${(j=a.exam)==null?void 0:j.id}/questions/create`,class:"btn btn-md btn-primary border-0 shadow me-2",type:"button"},{default:h(()=>[jt,Dt]),_:1},8,["href"]),r(l,{href:`/admin/exams/${(D=a.exam)==null?void 0:D.id}/questions/import`,class:"btn btn-md btn-success border-0 shadow text-white",type:"button"},{default:h(()=>[Pt,Et]),_:1},8,["href"]),t("div",Nt,[t("div",Ut,[t("form",{onSubmit:n[1]||(n[1]=Q((...e)=>d.handleSearch&&d.handleSearch(...e),["prevent"]))},[t("div",Vt,[st(t("input",{type:"text",class:"form-control","onUpdate:modelValue":n[0]||(n[0]=e=>d.search=e),placeholder:"masukkan kata kunci dan enter..."},null,512),[[lt,d.search]]),Ot])],32)])]),t("div",Ft,[t("table",It,[Jt,Kt,t("tbody",null,[(_(!0),m(W,null,nt((E=(P=a.exam)==null?void 0:P.questions)==null?void 0:E.data,(e,I)=>{var J,K,z,R,Y;return _(),m("tr",{key:I},[t("td",zt,s(++I+(((K=(J=a.exam)==null?void 0:J.questions)==null?void 0:K.current_page)-1)*((R=(z=a.exam)==null?void 0:z.questions)==null?void 0:R.per_page)),1),t("td",null,[e!=null&&e.question?(_(),m("div",{key:0,class:"fw-bold",innerHTML:e==null?void 0:e.question},null,8,Rt)):Z("",!0),e!=null&&e.question_file?(_(),m("audio",Yt,[t("source",{src:`/storage/exams/question/${e==null?void 0:e.question_file}`,type:"audio/mpeg"},null,8,Gt)])):Z("",!0),Qt,t("ol",Wt,[t("li",{innerHTML:e==null?void 0:e.option_1,class:b({"text-success fw-bold":(e==null?void 0:e.answer)=="1"})},null,10,Xt),t("li",{innerHTML:e==null?void 0:e.option_2,class:b({"text-success fw-bold":(e==null?void 0:e.answer)=="2"})},null,10,Zt),t("li",{innerHTML:e==null?void 0:e.option_3,class:b({"text-success fw-bold":(e==null?void 0:e.answer)=="3"})},null,10,$t),t("li",{innerHTML:e==null?void 0:e.option_4,class:b({"text-success fw-bold":(e==null?void 0:e.answer)=="4"})},null,10,qt),t("li",{innerHTML:e==null?void 0:e.option_5,class:b({"text-success fw-bold":(e==null?void 0:e.answer)=="5"})},null,10,te)])]),t("td",ee,[r(l,{href:`/admin/exams/${(Y=a.exam)==null?void 0:Y.id}/questions/${e==null?void 0:e.id}/edit`,class:"btn btn-sm btn-info border-0 shadow me-2",type:"button"},{default:h(()=>[ae]),_:2},1032,["href"]),t("button",{onClick:Q(de=>{var G;return d.destroy((G=a.exam)==null?void 0:G.id,e==null?void 0:e.id)},["prevent"]),class:"btn btn-sm btn-danger border-0"},ne,8,se)])])}),128))])])]),r(c,{links:(N=a.exam)==null?void 0:N.questions.links,show:(V=(U=a.exam)==null?void 0:U.questions)==null?void 0:V.per_page,total:(F=(O=a.exam)==null?void 0:O.questions)==null?void 0:F.total,align:"end"},null,8,["links","show","total"])])])])])])],64)}const he=ot(dt,[["render",oe]]);export{he as default};
