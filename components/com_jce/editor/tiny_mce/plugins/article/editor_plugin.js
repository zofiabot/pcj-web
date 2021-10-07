/* jce - 2.9.16 | 2021-09-20 | https://www.joomlacontenteditor.net | Copyright (C) 2006 - 2021 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){var DOM=tinymce.DOM,each=tinymce.each,VK=tinymce.VK,BACKSPACE=VK.BACKSPACE,DELETE=VK.DELETE;tinymce.create("tinymce.plugins.ArticlePlugin",{init:function(ed,url){function isReadMore(n){return ed.dom.is(n,"hr.mce-item-readmore")}function isPageBreak(n){return ed.dom.is(n,"hr.mce-item-pagebreak")}function _cancelResize(){each(ed.dom.select("hr.mce-item-pagebreak, hr.mce-item-readmore"),function(n){n.onresizestart=function(){return!1},n.onbeforeeditfocus=function(){return!1}})}var self=this;self.editor=ed,self.url=url,ed.addCommand("mceReadMore",function(){return ed.dom.get("system-readmore")?(alert(ed.getLang("article.readmore_alert","There is already a Read More break inserted in this article. Only one such break is permitted. Use a Pagebreak to split the page up further.")),!1):void self._insertBreak("readmore",{id:"system-readmore"})}),ed.addCommand("mcePageBreak",function(ui,v){var n=ed.selection.getNode();isPageBreak(n)?self._updatePageBreak(n,v):self._insertBreak("pagebreak",v)}),ed.getParam("article_show_readmore",!0)&&ed.addButton("readmore",{title:"article.readmore",cmd:"mceReadMore"}),ed.onInit.add(function(){ed.theme&&ed.theme.onResolveName&&ed.theme.onResolveName.add(function(theme,o){var v,n=o.node;n&&"HR"===n.nodeName&&/mce-item-pagebreak/.test(n.className)&&(v="pagebreak"),n&&"HR"===n.nodeName&&/mce-item-readmore/.test(n.className)&&(v="readmore"),v&&(o.name=v)})}),ed.onNodeChange.add(function(ed,cm,n){cm.setActive("readmore",isReadMore(n)),cm.setActive("pagebreak",isPageBreak(n)),ed.dom.removeClass(ed.dom.select("hr.mce-item-pagebreak.mce-item-selected, hr.mce-item-readmore.mce-item-selected"),"mce-item-selected"),(isPageBreak(n)||isReadMore(n))&&ed.dom.addClass(n,"mce-item-selected")}),ed.onBeforeSetContent.add(function(ed,o){o.content=o.content.replace(/<hr([^>]*)alt="([^"]+)"([^>]+)>/gi,'<hr$1data-mce-alt="$2"$3>')}),ed.onPostProcess.add(function(ed,o){o.get&&(o.content=o.content.replace(/<hr([^>]*)data-mce-alt="([^"]+)"([^>]+)>/gi,'<hr$1alt="$2"$3>'))}),ed.onSetContent.add(function(){tinymce.isIE&&_cancelResize()}),ed.onGetContent.add(function(){tinymce.isIE&&_cancelResize()}),ed.onKeyDown.add(function(ed,e){if(e.keyCode==BACKSPACE||e.keyCode==DELETE){var s=ed.selection,n=s.getNode();ed.dom.is(n,"hr.mce-item-pagebreak, hr.mce-item-readmore")&&(ed.dom.remove(n),e.preventDefault())}}),ed.onPreInit.add(function(){ed.settings.compress.css||ed.dom.loadCSS(url+"/css/content.css"),ed.parser.addNodeFilter("hr",function(nodes){for(var i=0;i<nodes.length;i++){var node=nodes[i],id=node.attr("id")||"",cls=node.attr("class")||"";if("system-readmore"==id||/system-pagebreak/.test(cls)){var cls=/system-pagebreak/.test(cls)?"mce-item-pagebreak":"mce-item-readmore";node.attr("class",cls),node.attr("alt")&&(node.attr("data-mce-alt",node.attr("alt")),node.attr("alt",null))}}}),ed.serializer.addNodeFilter("hr",function(nodes,name,args){for(var i=0;i<nodes.length;i++){var node=nodes[i],cls=node.attr("class")||"";/mce-item-(pagebreak|readmore)/.test(cls)&&(/mce-item-pagebreak/.test(node.attr("class"))?node.attr("class","system-pagebreak"):(node.attr("class",null),node.attr("id","system-readmore")),node.attr("data-mce-alt")&&(node.attr("alt",node.attr("data-mce-alt")),node.attr("data-mce-alt",null)))}})}),ed.getParam("article_show_pagebreak",!0)&&ed.addButton("pagebreak",{title:"article.pagebreak",onclick:function(){var html='<div class="mceModalRow">   <label for="'+ed.id+'article_title">'+ed.getLang("article.title","Title")+'</label>   <div class="mceModalControl">       <input type="text" id="'+ed.id+'_article_title" autofocus />   </div></div><div class="mceModalRow">   <label for="'+ed.id+'_article_alt">'+ed.getLang("article.alias","Alias")+'</label>   <div class="mceModalControl">       <input type="text" id="'+ed.id+'_article_alt" />   </div></div>';ed.windowManager.open({title:ed.getLang("article.pagebreak","PageBreak"),content:html,size:"mce-modal-landscape-small",open:function(){var label=ed.getLang("insert","Insert"),title=DOM.get(ed.id+"_article_title"),alt=DOM.get(ed.id+"_article_alt"),o=self._getPageBreak();o&&(label=ed.getLang("update","Update"),title.value=o.title||"",alt.value=o.alt||""),DOM.setHTML(this.id+"_insert",label),window.setTimeout(function(){title.focus()},10)},buttons:[{title:ed.getLang("cancel","Cancel"),id:"cancel"},{title:ed.getLang("insert","Insert"),id:"insert",onsubmit:function(e){var title=DOM.getValue(ed.id+"_article_title"),alt=DOM.getValue(ed.id+"_article_alt");ed.execCommand("mcePageBreak",!1,{title:title,alt:alt})},classes:"primary"}]})}})},_getPageBreak:function(){var o,ed=this.editor,n=ed.selection.getNode();return ed.dom.is(n,"hr.mce-item-pagebreak")&&(o={title:ed.dom.getAttrib(n,"title",""),alt:ed.dom.getAttrib(n,"data-mce-alt","")}),o},_updatePageBreak:function(n,v){var ed=this.editor;tinymce.extend(v,{"data-mce-alt":v.alt||""}),v.alt=null,ed.dom.setAttribs(n,v)},_insertBreak:function(s,args){var ns,h,hr,p,ed=this.editor,dom=ed.dom,n=ed.selection.getNode(),blocks="H1,H2,H3,H4,H5,H6,P,DIV,ADDRESS,PRE,FORM,TABLE,OL,UL,CAPTION,BLOCKQUOTE,CENTER,DL,DIR,FIELDSET,NOSCRIPT,NOFRAMES,MENU,ISINDEX,SAMP,SECTION,ARTICLE,HGROUP,ASIDE,FIGURE";n=dom.getParent(n,blocks,"BODY")||n,tinymce.extend(args,{class:"pagebreak"==s?"mce-item-pagebreak":"mce-item-readmore","data-mce-alt":args.alt||null}),args.alt=null,"readmore"==s&&(args.id="system-readmore"),ed.execCommand("mceInsertContent",!1,'<span id="mce_hr_marker" data-mce-type="bookmark">\ufeff</span>',{skip_undo:1});var marker=dom.get("mce_hr_marker"),hr=dom.create("hr",args);if(dom.isBlock(n)){if(p=dom.getParent(marker,blocks,"BODY"),"P"==p.nodeName||"DIV"==p.nodeName)if(p.className.indexOf("wf-column")!==-1){var col=dom.getParent(n,".wf-columns");dom.insertAfter(marker,col)}else dom.split(p,marker),ns=marker.nextSibling,ns&&ns.nodeName==p.nodeName&&(/^(\s|&nbsp;|\u00a00)*?$/.test(h)||"<br>"==h)&&dom.remove(ns);else for(p?"BODY"==p.parentNode.nodeName?dom.insertAfter(marker,p):p.parentNode.insertBefore(marker,p):"BODY"==n.parentNode.nodeName?dom.insertAfter(marker,n):n.parentNode.insertBefore(marker,n),p=marker.parentNode;/^(H[1-6]|ADDRESS|PRE|FORM|TABLE|OL|UL|CAPTION|BLOCKQUOTE|CENTER|DL|DIR|FIELDSET|NOSCRIPT|NOFRAMES|MENU|ISINDEX|SAMP)$/.test(p.nodeName);)p.parentNode.insertBefore(marker,p),p=marker.parentNode;if(ns=marker.nextSibling,!ns){var el=ed.getParam("forced_root_block")||"br";ns=ed.dom.create(el),"br"!=el&&(ns.innerHTML=" "),ed.dom.insertAfter(ns,marker),s=ed.selection.select(ns),ed.selection.collapse(1)}}ed.dom.replace(hr,marker),ed.undoManager.add()}}),tinymce.PluginManager.add("article",tinymce.plugins.ArticlePlugin)}();