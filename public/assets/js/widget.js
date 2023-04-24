const selectCountry = document.querySelector('.container-filter select[name="countries"]')
if ( selectCountry ) {
    selectCountry.addEventListener('change', ({ target }) => {
        const contryID = target.value || null;
        if ( contryID == null ) return

        if ( contryID == 'all' )
            document.querySelectorAll('tbody tr').forEach( player => player.removeAttribute('style') )
        else
            document.querySelectorAll('tbody tr').forEach( player => player.style.display = 'none' )
            document.querySelectorAll('.'+contryID).forEach( player => player.removeAttribute('style') )
    })
}


const selectSession = document.querySelector('.container-filter select[name="sessions"]')
if ( selectSession ) {
    selectSession.addEventListener('change', async ({ target }) => {
        const contryID = target.value || null;
        if ( contryID == null ) return

        const scopes = 'topscores:getTopScoresBySession'
        const options = {
            method: 'POST',
            credentials: "same-origin",
            body: JSON.stringify({ 'scopes': scopes, 'sessionid': contryID }),
           
        }

        const response = await fetch('/api-calls.php', options)
        .then(response => response.json())
        .then( objplayer => {
            if ( objplayer.message != 'ok' ) {
                Swal.fire({
                    title: 'Lo sentimos',
                    text: "Ocurrio un error con esta Sesion, intentalo más tarde",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                })
                return;
            }

            let players = '';
            let cont = 1;
            objplayer.data.forEach( session => {
                players += `<tr>
                                <td class="center padding-short">
                                    ${ cont }
                                </td>
                                <td> 
                                    <img src="${ session.player.image_path }" alt="${ session.player.display_name }" /> 
                                    ${ session.player.display_name }
                                </td>
                                <td class="country"> 
                                    <img src="${ session.player.country.image_path }" alt="${ session.player.country.name }" /> 
                                    ${ session.player.country.name }
                                </td>
                                <td> 
                                    ${  !session.player.position ? '-' : session.player.position.name  } 
                                </td>
                                <td class="center"> 
                                    ${ getEdad( session.player.date_of_birth ) } 
                                </td>
                                <td class="center"> ${ session.player.gender } </td>
                                <td class="center"> ${ session.total } </td>
                            </tr>`
                    cont++
            } )

            document.querySelectorAll('tbody tr').forEach( tr => tr.remove() )
            document.querySelector('tbody').insertAdjacentHTML('beforeend', players)
        })
        .catch( error => {
            Swal.fire({
                title: 'Lo sentimos',
                text: "Ocurrio un error, intentelo más tarde",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            })

            console.log(error);
        })
        
    })
}


const getEdad = ( dateString ) => {
    const today = new Date()
    const birthdate = new Date( dateString )
    let age = today.getFullYear() - birthdate.getFullYear()
    let differenceMonths = today.getMonth() - birthdate.getMonth()
    if ( differenceMonths < 0 || 
         (differenceMonths === 0 && today.getDate() < birthdate.getDate()) )
        age--
    
    return age
}