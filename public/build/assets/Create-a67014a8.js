import{L as S}from"./Admin-79ed5fa9.js";import{H as L,L as A,r as E,b,o as i,c as n,d as v,w,e,f as q,g as l,v as y,K as u,t as d,j as c,m as g,F as k,i as p,W as m,k as N,l as x}from"./app-7aa65b10.js";import{S as _}from"./sweetalert2.all-780e3ebe.js";import{E as j}from"./Editor-204e211b.js";import{_ as M}from"./_plugin-vue_export-helper-c27b6911.js";const B={layout:S,components:{Head:L,Link:A,Editor:j},props:{errors:Object,peran:Array,level:Array},setup(){const r=E({title:"",peran_id:"",level_id:"",duration:"",description:"",random_question:"",random_answer:"",show_answer:""});return{form:r,submit:()=>{N.Inertia.post("/admin/exams",{title:r.title,peran_id:r.peran_id,level_id:r.level_id,duration:r.duration,description:r.description,random_question:r.random_question,random_answer:r.random_answer,show_answer:r.show_answer},{onSuccess:()=>{_.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:s=>{s.addEventListener("mouseenter",_.stopTimer),s.addEventListener("mouseleave",_.resumeTimer)}}).fire({icon:"success",title:"Data berhasil disimpan."})},onError:t=>{t.message&&_.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:f=>{f.addEventListener("mouseenter",_.stopTimer),f.addEventListener("mouseleave",_.resumeTimer)}}).fire({icon:"error",title:t.message||"Data gagal disimpan."})}})}}}},C=e("title",null,"Tambah Ujian ",-1),D={class:"container-fluid mb-5 mt-5"},Y={class:"row"},H={class:"col-md-12"},F=e("i",{class:"fa fa-long-arrow-alt-left me-2"},null,-1),O=x(" Kembali"),K={class:"card border-0 shadow"},P={class:"card-body"},R=e("h5",null,[e("i",{class:"fa fa-edit"}),x(" Tambah Ujian")],-1),z=e("hr",null,null,-1),I={class:"mb-4"},J=e("label",null,"Nama Ujian",-1),W={key:0,class:"invalid-feedback mt-2"},G={class:"row"},Q={class:"col-md-4"},X={class:"mb-4"},Z=e("label",null,"Function",-1),$=["value"],ee={key:0,class:"invalid-feedback mt-2"},oe={class:"col-md-4"},se={class:"mb-4"},te=e("label",null,"Level",-1),ae=["value"],ie={key:0,class:"invalid-feedback mt-2"},ne={class:"col-md-4"},re={class:"mb-4"},le=e("label",null,"Durasi (Menit)",-1),de={key:0,class:"invalid-feedback mt-2"},ce={class:"row"},me={class:"col-md-4"},_e={class:"mb-4"},ue=e("label",{class:"d-block"},"Acak Soal",-1),fe={class:"form-check form-check-inline"},he=e("label",{class:"form-check-label",for:"radioAcakSoal1"}," Ya ",-1),be={class:"form-check form-check-inline"},ve=e("label",{class:"form-check-label",for:"radioAcakSoal2"}," Tidak ",-1),ke={key:0,class:"text-danger text-muted small"},we={class:"col-md-4"},ye={class:"mb-4"},ge=e("label",{class:"d-block"},"Acak Jawaban",-1),pe={class:"form-check form-check-inline"},xe=e("label",{class:"form-check-label",for:"random_answer1"}," Ya ",-1),Ve={class:"form-check form-check-inline"},Te=e("label",{class:"form-check-label",for:"random_answer"}," Tidak ",-1),Ue={key:0,class:"text-danger text-muted small"},Se={class:"col-md-4"},Le={class:"mb-4"},Ae=e("label",{class:"d-block"},"Tampilkan Hasil ",-1),Ee={class:"form-check form-check-inline"},qe=e("label",{class:"form-check-label",for:"show_answer2"}," Ya ",-1),Ne={class:"form-check form-check-inline"},je=e("label",{class:"form-check-label",for:"show_answer"}," Tidak ",-1),Me={key:0,class:"text-danger text-muted small"},Be={class:"mb-4"},Ce=e("label",null,"Deskripsi",-1),De={key:0,class:"invalid-feedback mt-2"},Ye=e("button",{type:"submit",class:"btn btn-md btn-primary border-0 shadow me-2"}," Simpan ",-1),He=e("button",{type:"reset",class:"btn btn-md btn-warning border-0 shadow"}," Reset ",-1);function Fe(r,a,t,s,f,Oe){const V=b("Head"),T=b("Link"),U=b("Editor");return i(),n(k,null,[v(V,null,{default:w(()=>[C]),_:1}),e("div",D,[e("div",Y,[e("div",H,[v(T,{href:"/admin/exams",class:"btn btn-md btn-primary border-0 shadow mb-3",type:"button"},{default:w(()=>[F,O]),_:1}),e("div",K,[e("div",P,[R,z,e("form",{onSubmit:a[11]||(a[11]=q((...o)=>s.submit&&s.submit(...o),["prevent"]))},[e("div",I,[J,l(e("input",{type:"text",class:u(["form-control",t.errors.title?"is-invalid":""]),placeholder:"Masukkan Nama Ujian","onUpdate:modelValue":a[0]||(a[0]=o=>s.form.title=o)},null,2),[[y,s.form.title]]),t.errors.title?(i(),n("div",W,d(t.errors.title),1)):c("",!0)]),e("div",G,[e("div",Q,[e("div",X,[Z,l(e("select",{class:u(["form-select",t.errors.peran_id?"is-invalid":""]),"onUpdate:modelValue":a[1]||(a[1]=o=>s.form.peran_id=o)},[(i(!0),n(k,null,p(t.peran,(o,h)=>(i(),n("option",{key:h,value:o==null?void 0:o.id_peran},d(o==null?void 0:o.nm_peran),9,$))),128))],2),[[g,s.form.peran_id]]),t.errors.peran_id?(i(),n("div",ee,d(t.errors.peran_id),1)):c("",!0)])]),e("div",oe,[e("div",se,[te,l(e("select",{class:u(["form-select",t.errors.level_id?"is-invalid":""]),"onUpdate:modelValue":a[2]||(a[2]=o=>s.form.level_id=o)},[(i(!0),n(k,null,p(t.level,(o,h)=>(i(),n("option",{key:h,value:o==null?void 0:o.id_level},d(o==null?void 0:o.level),9,ae))),128))],2),[[g,s.form.level_id]]),t.errors.level_id?(i(),n("div",ie,d(t.errors.level_id),1)):c("",!0)])]),e("div",ne,[e("div",re,[le,l(e("input",{type:"number",min:"1",class:u(["form-control",t.errors.duration?"is-invalid":""]),placeholder:"Masukkan Durasi Ujian (Menit)","onUpdate:modelValue":a[3]||(a[3]=o=>s.form.duration=o)},null,2),[[y,s.form.duration]]),t.errors.duration?(i(),n("div",de,d(t.errors.duration),1)):c("",!0)])])]),e("div",ce,[e("div",me,[e("div",_e,[ue,e("div",fe,[l(e("input",{class:"form-check-input",type:"radio",name:"radioAcakSoal",id:"radioAcakSoal1",value:"Y","onUpdate:modelValue":a[4]||(a[4]=o=>s.form.random_question=o)},null,512),[[m,s.form.random_question]]),he]),e("div",be,[l(e("input",{class:"form-check-input",type:"radio",name:"radioAcakSoal",id:"radioAcakSoal2",value:"N","onUpdate:modelValue":a[5]||(a[5]=o=>s.form.random_question=o)},null,512),[[m,s.form.random_question]]),ve]),t.errors.random_question?(i(),n("div",ke,d(t.errors.random_question),1)):c("",!0)])]),e("div",we,[e("div",ye,[ge,e("div",pe,[l(e("input",{class:"form-check-input",type:"radio",name:"random_answer",id:"random_answer1",value:"Y","onUpdate:modelValue":a[6]||(a[6]=o=>s.form.random_answer=o)},null,512),[[m,s.form.random_answer]]),xe]),e("div",Ve,[l(e("input",{class:"form-check-input",type:"radio",name:"random_answer",id:"random_answer",value:"N","onUpdate:modelValue":a[7]||(a[7]=o=>s.form.random_answer=o)},null,512),[[m,s.form.random_answer]]),Te]),t.errors.random_answer?(i(),n("div",Ue,d(t.errors.random_answer),1)):c("",!0)])]),e("div",Se,[e("div",Le,[Ae,e("div",Ee,[l(e("input",{class:"form-check-input",type:"radio",name:"show_answer",id:"show_answer2",value:"Y","onUpdate:modelValue":a[8]||(a[8]=o=>s.form.show_answer=o)},null,512),[[m,s.form.show_answer]]),qe]),e("div",Ne,[l(e("input",{class:"form-check-input",type:"radio",name:"show_answer",id:"show_answer",value:"N","onUpdate:modelValue":a[9]||(a[9]=o=>s.form.show_answer=o)},null,512),[[m,s.form.show_answer]]),je]),t.errors.show_answer?(i(),n("div",Me,d(t.errors.show_answer),1)):c("",!0)])])]),e("div",Be,[Ce,v(U,{"api-key":"no-api-key",modelValue:s.form.description,"onUpdate:modelValue":a[10]||(a[10]=o=>s.form.description=o),class:u(t.errors.description?"is-invalid":""),init:{menubar:!1,plugins:"lists link image emoticons",toolbar:"styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons"}},null,8,["modelValue","class"]),t.errors.description?(i(),n("div",De,d(t.errors.description),1)):c("",!0)]),Ye,He],32)])])])])])],64)}const Je=M(B,[["render",Fe]]);export{Je as default};