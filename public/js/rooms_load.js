/**
 * Created by hoanganh25991 on 29/09/16.
 */
let rooms_file = document.querySelector('input[name="rooms_file"]');
rooms_file.addEventListener('change', handleFile);
function handleFile(e){
	let files = e.target.files;
	let f1 = files[0];
	let fileReader = new FileReader();
	fileReader.readAsBinaryString(f1);
	fileReader.onload = (e)=>{
		let data = e.target.result;
		//noinspection JSUnresolvedVariable
		let wb = XLSX.read(data, {type: 'binary'});
		let wbJson = to_json(wb);
		function to_json(workbook){
			let result = {};
			workbook.SheetNames.forEach(function(sheetName){
				var rowObjArr = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
				if(rowObjArr.length > 0){
					result[sheetName] = rowObjArr;
				}
			});
			return result;
		};
		// console.log(wbJson);
		let wbJsonPre= document.querySelector('#wbJsonPre');
		wbJsonPre.innerHTML = JSON.stringify(wbJson);
	}
};