/*document.addEventListener('click', function(e) {
    if (e.target.getAttribute('data-postid')) {
      const postId = e.target.getAttribute('data-postid');

        fetch('delete_post.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `ID=${postId}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        });
    }
  });*/