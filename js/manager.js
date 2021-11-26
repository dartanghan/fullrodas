var companiesStore;
var companiesGrid;

var companyObjectsStore;
var companyObjectsGrid;


var processing = false;

/**
 * Salva a empresa no servidor.
 * =)
 */
function saveCompany( code, name, imageurl, type ){
	var alertProg = Ext.Msg.progress('Aguarde','Salvando alterações...');
	alertProg. updateProgress(1);
	if( !processing ){
		processing = true;
		alertProg. updateProgress(2);
		Ext.Ajax.request({
			url: 'pages/manager_control.php?metodo=saveCompany',
			params:{
				company_code: code,
				company_name: name,
				company_image_url: imageurl,
				company_type: type
			},
			success: function(){
				alertProg. updateProgress(4);
				processing = false;
				companiesStore.reload();
				alertProg.hide();
			}
		});
	}else{
		Ext.Msg.alert('Aguarde','Aguarde a conclusão de todas as requisições.');
	}
}

/**
 * Salva o produto no servidor.
 * =)
 */
function saveCompanyObject( companyCode, code, name, imageurl, description ){
	var alertProg = Ext.Msg.progress('Aguarde','Salvando alterações...');
	alertProg. updateProgress(1);
	if( !processing ){
		processing = true;
		alertProg. updateProgress(2);
		Ext.Ajax.request({
			url: 'pages/manager_control.php?metodo=saveCompanyObject',
			params:{
				company_code: companyCode,
				object_code: code,
				object_name: name,
				object_image_url: imageurl,
				object_description: description
			},
			success: function(){
				alertProg. updateProgress(4);
				processing = false;
				companyObjectsStore.reload();
				alertProg.hide();
			}
		});
	}else{
		Ext.Msg.alert('Aguarde','Aguarde a conclusão de todas as requisições.');
	}
}


/**
 * Stores são responsáveis por prover os dados.
 * Teoricamente são grandes arrays carregados
 * com dados vindos de um lugar, como uma pagina.
 *
 * Neste método inicializamos estes stores.
 */
function buildStores(){
	companiesStore = new Ext.data.Store({
		url: 'pages/manager_control.php?metodo=getCompanies',
		autoLoad: true,
		reader: new Ext.data.JsonReader({
			root: 'companies',
			id:	'company_code'
		},[
			'company_code','company_name','company_image_url','company_type'
		])
	});
	companyObjectsStore = new Ext.data.Store({
		url: 'pages/manager_control.php?metodo=getCompanyObjects',
		autoLoad: true,
		reader: new Ext.data.JsonReader({
			root: 'companyObjects',
			id:	'object_code'
		},[
			'object_code','object_name','object_image_url','object_description','company_code'
		])
	});
}
function buildContentGrid(){
	companiesGrid = new Ext.grid.EditorGridPanel({
		store: companiesStore,
		loadMask: true,
		columns: [
			{ header: 'Código', dataIndex: 'company_code', width: 100 },
			{ header: 'Nome', dataIndex: 'company_name', width: 200, editor: new Ext.form.TextField({})},
			{ header: 'Tipo', dataIndex: 'company_type', width: 100, editor:
				new Ext.form.ComboBox({
				    store: new Ext.data.SimpleStore({
					    fields: ['typecode', 'typename'],
					    data : [ [1,'Carro'], [2,'Roda']]
					}),
					valueField : 'typecode',
				    displayField:'typename',
				    mode: 'local',
				    triggerAction: 'all'
				})
			},
			{ header: 'Caminho Imagem', dataIndex: 'company_image_url', width: 500, editor: new Ext.form.TextField({})}
		],
		sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
		bbar:[
			new Ext.Button({
				text: 'Adicionar',
				handler: function(){
					companiesGrid.store.add(new Ext.data.Record({
						company_code: '---',
						company_name: 'Digite um nome',
						company_image_url: 'Digite uma url para imagem',
						company_type: 'tipo'
					}))
				}
			}),
			'-',
			new Ext.Button({
				text:'Salvar',
				iconCls: 'button-save',
				handler: function(){
					var record = companiesGrid.getSelectionModel().getSelected();
					if( record ){
						saveCompany(
							record.get('company_code'),
							record.get('company_name'),
							record.get('company_image_url'),
							record.get('company_type')
						)
					}else{
						Ext.Msg.alert('OPSSSS!','Selecione ao menos uma linha para persistir em banco.');
					}
				}
			})
		]

	});

	companyObjectsGrid = new Ext.grid.EditorGridPanel({
		store: companyObjectsStore,
		loadMask: true,
		columns: [
			{ header: 'Código', dataIndex: 'object_code', width: 100 },
			{ header: 'Nome', dataIndex: 'object_name', width: 200, editor: new Ext.form.TextField({})},
			{ header: 'Descrição', dataIndex: 'object_description', width: 200, editor: new Ext.form.TextField({}) },
			{ header: 'Caminho Imagem', dataIndex: 'object_image_url', width: 300, editor: new Ext.form.TextField({})},
			{ header: 'Empresa', dataIndex: 'company_code', width: 100, editor:
				new Ext.form.ComboBox({
				    store: companiesStore,
				    displayField:'company_name',
					valueField : 'company_code',
				    mode: 'local',
				    triggerAction: 'all'
				})
			 }
		],
		sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
		bbar:[
			new Ext.Button({
				text: 'Adicionar',
				handler: function(){
					companyObjectsGrid.store.add(new Ext.data.Record({
						object_code: '---',
						object_name: 'Digite um nome',
						object_image_url: 'Digite uma url para imagem',
						object_description: 'descrição',
						company_code: 'companhia'
					}))
				}
			}),
			'-',
			new Ext.Button({
				text:'Salvar',
				iconCls: 'button-save',
				handler: function(){
					var record = companyObjectsGrid.getSelectionModel().getSelected();
					if( record ){
						saveCompanyObject(
							record.get('company_code'),
							record.get('object_code'),
							record.get('object_name'),
							record.get('object_image_url'),
							record.get('object_description')
						)
					}else{
						Ext.Msg.alert('OPSSSS!','Selecione ao menos uma linha para persistir em banco.');
					}
				}
			})
		]

	});

}


/**
 * Função de inicialização;.
 * Aqui iniciamos stores e elementos
 * de toda a interface.
 */
function init(){
	// vamos montar as stores..
	// elas sao usadas para pegar os dados do servidor
	// e deixar legivel pelo java script.
	buildStores();

	// vamos agora montar as grids
	// com os dados vindos do banco...
	buildContentGrid();

	var view = new Ext.Viewport({
		title:'FULLRODAS Manager',
		layout: 'border',
		border: true,
		frame: true,
		items:[
			new Ext.TabPanel({
				region:'center',
			    activeTab: 0,
			    height: 400,
			    items: [
				    new Ext.Panel({
				    	layout: 'fit',
				    	title: 'Companies',
				        items: companiesGrid // tabela de dados..
				    }),{
				    	layout: 'fit',
				        title: 'Companies Objects',
				        items: companyObjectsGrid // tabela de dados..
				    }]
			}),

			new Ext.Panel({
				region:'north',
				height:100
			})

		]
	})
}
Ext.onReady( init );