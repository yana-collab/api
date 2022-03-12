const id = null;
async function getNews () {
    let result = await fetch('http://192.168.64.3/server/news');
    let news = await result.json();

    document.getElementById('news-list').innerHTML = '';
  news.forEach((item) => {
      document.getElementById('news-list').innerHTML+=`
     <div class="card m-4" style="width: 16rem;">
     <div class="card-body">
     <h4 class="card-title text-success">${item.title}</h4>
     <p class="card-text">${item.content}</p>
     <a class="text-danger" href="${item.source}">${item.source}</a>
</div>
<div class="d-flex justify-content-around mb-2" >
     <button type="button" class="btn btn-danger" onclick="deleteNews(${item.id})">Delete</button>
     <button type="button" class="btn btn-info" onclick="updateNews('${item.id}', '${item.title}', '${item.content}')">Update</button>
     </div>
</div>
      `
  })
}

function clear () {
        document.getElementById('title').value = '';
        document.getElementById('content').value = '';
}


async function addNews() {
    const title = document.getElementById('title').value,
        content = document.getElementById('content').value;

    let formData = new FormData();
    formData.append('title', title);
    formData.append('content', content);

    const response = await fetch('http://192.168.64.3/server/news', {
        method:'POST',
        body: formData
    });
    const data = await response.json();
    if(data.status === true) {
        await getNews();
        clear();

    }
}

async function deleteNews(id) {

    const response = await fetch(`http://192.168.64.3/server/news/${id}`, {
        method: 'DELETE'
    })
    const data = await response.json();
    if(data.status === true) {
        alert("News was deleted")
        await getNews();
    }
}

async function updateNews(id, title, content) {
    id = id;
    document.getElementById('title').value = title;
        document.getElementById('content').value = content;
        const data = {
            title: title,
            content: content
        };
        const response = await fetch(`http://192.168.64.3/server/news/${id}`, {
            method: 'PATCH',
            body:JSON.stringify(data)
        });
}

getNews();