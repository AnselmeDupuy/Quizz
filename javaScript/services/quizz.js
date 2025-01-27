

export const login = async ( ) => {
    const formData = new URLSearchParams();
    formData.append('', );
    formData.append('', );

    const response = await fetch ('index.php?component=', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        method: 'POST',
        body: formData
    })
    return await response.json()
}