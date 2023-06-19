import{L as $}from"./Admin-79ed5fa9.js";import{P as q}from"./Pagination-d55f0985.js";import{H as ee,L as te,a as ae,b as u,o as _,c as m,d as r,w as h,e,t as s,f as Q,g as se,v as le,F as W,i as ne,k as X,l as f,j as Z,K as b}from"./app-7aa65b10.js";import{S as o}from"./sweetalert2.all-780e3ebe.js";import{_ as oe}from"./_plugin-vue_export-helper-c27b6911.js";const de={layout:$,components:{Head:ee,Link:te,Pagination:q},props:{errors:Object,exam:Object},setup(x){const n=ae(new URL(document.location).searchParams.get("q"));return{destroy:(p,v)=>{o.fire({title:"Apakah Anda yakin?",text:"Anda tidak akan dapat mengembalikan ini!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then(w=>{w.isConfirmed&&X.Inertia.delete(`/admin/exams/${p}/questions/${v}/destroy`,{onSuccess:()=>{o.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:c=>{c.addEventListener("mouseenter",o.stopTimer),c.addEventListener("mouseleave",o.resumeTimer)}}).fire({icon:"success",title:"Data berhasil dihapus."})},onError:l=>{l.message&&o.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:i=>{i.addEventListener("mouseenter",o.stopTimer),i.addEventListener("mouseleave",o.resumeTimer)}}).fire({icon:"error",title:l.message||"Data gagal dihapus."})}})})},search:n,handleSearch:()=>{X.Inertia.get(`/admin/exams/${x.exam.id}`,{q:n.value})}}}},re=e("title",null,"Detail Ujian",-1),ce={class:"container-fluid mb-5 mt-5"},ie={class:"row"},_e={class:"col-md-12"},me=e("i",{class:"fa fa-long-arrow-alt-left me-2"},null,-1),he=f(" Kembali"),be={class:"card border-0 shadow mb-4"},fe={class:"card-body"},we=e("h5",null,[e("i",{class:"fa fa-edit"}),f(" Detail Ujian")],-1),ue=e("hr",null,null,-1),xe={class:"table-responsive"},pe={class:"table table-bordered table-centered table-nowrap mb-0 rounded"},ve=e("td",{style:{width:"30%"},class:"fw-bold"}," Nama Ujian ",-1),ke=e("td",{class:"fw-bold"},"Function",-1),ge=e("td",{class:"fw-bold"},"Level",-1),ye=e("td",{class:"fw-bold"},"Acak Soal",-1),Le=e("td",{class:"fw-bold"},"Acak Jawaban",-1),Te=e("td",{class:"fw-bold"},"Tampilkan Hasil",-1),He=e("td",{class:"fw-bold"},"Jumlah Soal",-1),Me=e("td",{class:"fw-bold"},"Durasi (Menit)",-1),Se={class:"card border-0 shadow"},Ce={class:"card-body"},Be=e("h5",null,[e("i",{class:"fa fa-question-circle"}),f(" Soal Ujian ")],-1),Ae=e("hr",null,null,-1),je=e("i",{class:"fa fa-plus-circle"},null,-1),De=f(" Tambah"),Pe=e("i",{class:"fa fa-file-excel"},null,-1),Ee=f(" Import"),Ne={class:"row"},Ue={class:"col-md-6 col-12 mt-3"},Ve={class:"input-group"},Oe=e("span",{class:"input-group-text"},[e("i",{class:"fa fa-search"})],-1),Fe={class:"table-responsive mt-3"},Ie={class:"table table-bordered table-centered table-nowrap mb-0 rounded"},Je=e("thead",{class:"thead-dark"},[e("tr",{class:"border-0"},[e("th",{class:"border-0 rounded-start",style:{width:"5%"}}," No. "),e("th",{class:"border-0"},"Soal"),e("th",{class:"border-0 rounded-end",style:{width:"15%"}}," Aksi ")])],-1),Ke=e("div",{class:"mt-2"},null,-1),ze={class:"fw-bold text-center"},Re=["innerHTML"],Ye={key:1,controls:""},Ge=["src"],Qe=e("hr",null,null,-1),We={type:"A"},Xe=["innerHTML"],Ze=["innerHTML"],$e=["innerHTML"],qe=["innerHTML"],et=["innerHTML"],tt={class:"text-center"},at=e("i",{class:"fa fa-pencil-alt"},null,-1),st=["onClick"],lt=e("i",{class:"fa fa-trash"},null,-1),nt=[lt];function ot(x,n,a,d,p,v){var i,k,g,y,L,T,H,M,S,C,B,A,j,D,P,E,N,U,V,O,F;const w=u("Head"),l=u("Link"),c=u("Pagination");return _(),m(W,null,[r(w,null,{default:h(()=>[re]),_:1}),e("div",ce,[e("div",ie,[e("div",_e,[r(l,{href:"/admin/exams",class:"btn btn-md btn-primary border-0 shadow mb-3",type:"button"},{default:h(()=>[me,he]),_:1}),e("div",be,[e("div",fe,[we,ue,e("div",xe,[e("table",pe,[e("tbody",null,[e("tr",null,[ve,e("td",null,s((i=a.exam)==null?void 0:i.title),1)]),e("tr",null,[ke,e("td",null,s((g=(k=a.exam)==null?void 0:k.peran)==null?void 0:g.nm_peran),1)]),e("tr",null,[ge,e("td",null,s((L=(y=a.exam)==null?void 0:y.level)==null?void 0:L.level),1)]),e("tr",null,[ye,e("td",null,s((T=a.exam)==null?void 0:T.random_question),1)]),e("tr",null,[Le,e("td",null,s((H=a.exam)==null?void 0:H.random_answer),1)]),e("tr",null,[Te,e("td",null,s((M=a.exam)==null?void 0:M.show_answer),1)]),e("tr",null,[He,e("td",null,s((B=(C=(S=a.exam)==null?void 0:S.questions)==null?void 0:C.data)==null?void 0:B.length),1)]),e("tr",null,[Me,e("td",null,s((A=a.exam)==null?void 0:A.duration)+" Menit",1)])])])])])]),e("div",Se,[e("div",Ce,[Be,Ae,r(l,{href:`/admin/exams/${(j=a.exam)==null?void 0:j.id}/questions/create`,class:"btn btn-md btn-primary border-0 shadow me-2",type:"button"},{default:h(()=>[je,De]),_:1},8,["href"]),r(l,{href:`/admin/exams/${(D=a.exam)==null?void 0:D.id}/questions/import`,class:"btn btn-md btn-success border-0 shadow text-white",type:"button"},{default:h(()=>[Pe,Ee]),_:1},8,["href"]),e("div",Ne,[e("div",Ue,[e("form",{onSubmit:n[1]||(n[1]=Q((...t)=>d.handleSearch&&d.handleSearch(...t),["prevent"]))},[e("div",Ve,[se(e("input",{type:"text",class:"form-control","onUpdate:modelValue":n[0]||(n[0]=t=>d.search=t),placeholder:"masukkan kata kunci dan enter..."},null,512),[[le,d.search]]),Oe])],32)])]),e("div",Fe,[e("table",Ie,[Je,Ke,e("tbody",null,[(_(!0),m(W,null,ne((E=(P=a.exam)==null?void 0:P.questions)==null?void 0:E.data,(t,I)=>{var J,K,z,R,Y;return _(),m("tr",{key:I},[e("td",ze,s(++I+(((K=(J=a.exam)==null?void 0:J.questions)==null?void 0:K.current_page)-1)*((R=(z=a.exam)==null?void 0:z.questions)==null?void 0:R.per_page)),1),e("td",null,[t!=null&&t.question?(_(),m("div",{key:0,class:"white-space fw-bold",innerHTML:t==null?void 0:t.question},null,8,Re)):Z("",!0),t!=null&&t.question_file?(_(),m("audio",Ye,[e("source",{src:`/storage/exams/question/${t==null?void 0:t.question_file}`,type:"audio/mpeg"},null,8,Ge)])):Z("",!0),Qe,e("ol",We,[e("li",{class:b(["white-space",{"text-success fw-bold":(t==null?void 0:t.answer)=="1"}]),innerHTML:t==null?void 0:t.option_1},null,10,Xe),e("li",{class:b(["white-space",{"text-success fw-bold":(t==null?void 0:t.answer)=="2"}]),innerHTML:t==null?void 0:t.option_2},null,10,Ze),e("li",{class:b(["white-space",{"text-success fw-bold":(t==null?void 0:t.answer)=="3"}]),innerHTML:t==null?void 0:t.option_3},null,10,$e),e("li",{class:b(["white-space",{"text-success fw-bold":(t==null?void 0:t.answer)=="4"}]),innerHTML:t==null?void 0:t.option_4},null,10,qe),e("li",{class:b(["white-space",{"text-success fw-bold":(t==null?void 0:t.answer)=="5"}]),innerHTML:t==null?void 0:t.option_5},null,10,et)])]),e("td",tt,[r(l,{href:`/admin/exams/${(Y=a.exam)==null?void 0:Y.id}/questions/${t==null?void 0:t.id}/edit`,class:"btn btn-sm btn-info border-0 shadow me-2",type:"button"},{default:h(()=>[at]),_:2},1032,["href"]),e("button",{onClick:Q(dt=>{var G;return d.destroy((G=a.exam)==null?void 0:G.id,t==null?void 0:t.id)},["prevent"]),class:"btn btn-sm btn-danger border-0"},nt,8,st)])])}),128))])])]),r(c,{links:(N=a.exam)==null?void 0:N.questions.links,show:(V=(U=a.exam)==null?void 0:U.questions)==null?void 0:V.per_page,total:(F=(O=a.exam)==null?void 0:O.questions)==null?void 0:F.total,align:"end"},null,8,["links","show","total"])])])])])])],64)}const ht=oe(de,[["render",ot]]);export{ht as default};