const btnMostrarSeguimiento = document.querySelector( '#btnMostrarSeguimiento' )
const informe       = document.querySelector( '#informe' )
const informeWeb    = document.querySelector( '#informeWeb' )
const btnCrearPDF   = document.querySelector( '#btnCrearPDF' )
const btnCrearXLSX  = document.querySelector( '#btnCrearXLSX' )
const datosProfesor = document.querySelector( '#datosProfesor' )
const tablaEP1      = document.querySelector( '#EP1' )
const tablaEP2      = document.querySelector( '#EP2' )
const tablaAA      = document.querySelector( '#AA' )
const tablaHI      = document.querySelector( '#HI' )
const tablaAP      = document.querySelector( '#AP' )
const tablaAT      = document.querySelector( '#AT' )
//Guardamos las tablas en un vector
const tablas       = [ datosProfesor, tablaEP1, tablaEP2, tablaAA, tablaHI, tablaAP, tablaAT ]

const crearXLSX = () => {
  // const libroNuevo = XLSX.utils.book_new()
  // libroNuevo.Props = {
  //     Title: 'seguimiento',
  //     Subject: 'PRuebas',
  //     Author: 'Javier Mallen',
  //     CreatedDate: new Date( Date.now() ).toLocaleDateString()
  // }
  // //libroNuevo.SheetNames.push( 'Seguimiento' )
  // let hojaNueva = XLSX.table_to_sheet()
  // let datosGrabar = XLSX.utils.table_to_book( datosProfesor, { sheet: 'Seguimiento' } )
  // XLSX.utils.sheet_add_dom( tablaEP1, datosGrabar, { sheet: 'Seguimiento' } )
  // XLSX.writeFile( datosGrabar, 'Seguimiento2.xlsx' )

  const encabezados = [ 'Datos Profesor', 'EP1', 'EP2', 'AA', 'HI', 'AP', 'AT' ]

  /* Función que crea filas vacías */
  const creaFilasVacias = ( datos, numeroFilas ) => {
    const ref = XLSX.utils.decode_range( datos[ '!ref' ] ) // coge el rango original
    ref.e.r += numeroFilas // A las filas existentes añade una nueva
    datos[ '!ref' ] = XLSX.utils.encode_range(ref) // Se guarda la tabla
  }

  let datos;

  for (let i = 0; i < tablas.length; i++) {
    //La primera vez crea la variable datos, las siguientes añade tablas a los datos
    ( i == 0 ) ? datos =  XLSX.utils.aoa_to_sheet( [ [ encabezados[ i ] ] ] ) : XLSX.utils.sheet_add_aoa( datos, [ [ encabezados[ i ] ] ], { origin: -1 } )
    XLSX.utils.sheet_add_dom( datos, tablas[ i ], { origin: -1 } )
    creaFilasVacias( datos, 1 )
    
  }
  /* Crear libro y exportar */
  const libro = XLSX.utils.book_new()
  XLSX.utils.book_append_sheet( libro, datos, 'Seguimiento' )
  XLSX.writeFile( libro, 'Seguimiento.xlsx' )
}


btnMostrarSeguimiento.addEventListener( 'click', () => {
    if( informe.hasAttribute( 'hidden' )){
        informe.removeAttribute( 'hidden' )
    } else {
        informe.setAttribute( 'hidden','hidden' )
    }
    
})
//Función que crea html2pdf
btnCrearPDF.addEventListener( 'click', () => {
    const opt = {
        margin: 10,
        filename: 'seguimiento.pdf',
    }
    html2pdf().set( opt ).from( informeWeb ).save()
})

//Función que guarda el XLSX
btnCrearXLSX.addEventListener( 'click', crearXLSX )

