/* jce - 2.9.16 | 2021-09-20 | https://www.joomlacontenteditor.net | Copyright (C) 2006 - 2021 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){var each=tinymce.each;tinymce.create("tinymce.plugins.JoomlaPlugin",{init:function(ed,url){var self=this;self.editor=ed},createControl:function(n,cm){var ed=this.editor;if("joomla"!==n)return null;var plugins=ed.settings.joomla_xtd_buttons||[];if(!plugins.length)return null;var ctrl=cm.createSplitButton("joomla",{title:"joomla.buttons",icon:"joomla"});return ctrl.onRenderMenu.add(function(ctrl,menu){var ed=ctrl.editor,vp=ed.dom.getViewPort();each(plugins,function(plg){var href=plg.href||"";href&&(href=ed.dom.decode(href),href=href.replace(/(__jce__)/gi,ed.id),href=href.replace(/(e_name|editor)=([\w_]+)/gi,"$1="+ed.id));var item=menu.add({id:ed.dom.uniqueId(),title:plg.title,icon:plg.icon,onclick:function(e){return ed.lastSelectionBookmark=ed.selection.getBookmark(1),href&&(ed.windowManager.open({file:href,title:plg.title,width:Math.max(vp.w-40,896),height:Math.max(vp.h-40,707),size:"mce-modal-landscape-full",addver:!1}),window.Joomla&&window.Joomla.Modal&&window.Joomla.Modal.setCurrent(ed.windowManager)),plg.onclick&&new Function(plg.onclick).apply(),item.setSelected(!1),!1}})});var jModalCloseCore=function(){};window.jModalClose&&(jModalCloseCore=window.jModalClose),window.jModalClose=function(){var wm=ed.windowManager;return wm.count?wm.close():jModalCloseCore()};var SBoxClose=function(){};window.SqueezeBox?SBoxClose=window.SqueezeBox.close:window.SqueezeBox={},window.SqueezeBox.close=function(){var wm=ed.windowManager;return wm.count?wm.close():SBoxClose()}}),ed.onRemove.add(function(){ctrl.destroy()}),ctrl}}),tinymce.PluginManager.add("joomla",tinymce.plugins.JoomlaPlugin)}();