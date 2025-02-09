<?php
include_once "../database.php";

$sql4 = mysqli_query($connect, "SELECT * FROM newsfeed ORDER BY postdate DESC");

for ($x = 0; $row3 = mysqli_fetch_assoc($sql4); $x++) {
?>
    <div id="allpost">
        <div class="feedname">
            <img
                src="../profileimage/<?php echo $row3['img1'] ?>"
                alt=""
                class="homeprofile" />
            <h1 id="Postname">
                <?php echo $row3['fname'] . " " . $row3['lname'] ?>
            </h1>
        </div>
        <div class="Postcaption">
            <p id="Postcaption">
                <?php echo $row3['cappost'] ?>
            </p>
        </div>
        <div class="postpic">
            <img src="../profileimage/<?php echo $row3['imgpost'] ?>" alt="" id="postpic" />
        </div>

        <div class="like-section">
            <!-- Upvote button -->
            <button onclick="reactPost(<?php echo $row3['id'] ?>, 'up')" 
                    type="button" 
                    id="upbtn_<?php echo $row3['id'] ?>"
                    class="vote-btn <?php echo isset($_SESSION['up_' . $row3['id']]) ? 'voted' : ''; ?>">
                    <i class="fa-regular fa-thumbs-up"></i>
            </button>
            <!-- Downvote button -->
            <button onclick="reactPost(<?php echo $row3['id'] ?>, 'down')" 
                    type="button" 
                    id="downbtn_<?php echo $row3['id'] ?>"
                    class="vote-btn <?php echo isset($_SESSION['down_' . $row3['id']]) ? 'voted' : ''; ?>">
                    <i class="fa-regular fa-thumbs-down"></i>
            </button>
            <p id="likes_<?php echo $row3['id'] ?>" class="vote-count">Votes: <?php echo $row3['react'] ?></p>
        </div>
    </div>
<?php
}
?>

<script>
function reactPost(postId, voteType = 'up') { // Added default value for voteType
    const buttonId = (voteType === 'up' ? 'upbtn_' : 'downbtn_') + postId;
    const button = document.getElementById(buttonId);
    
    // Check if already voted
    if (button.classList.contains('voted')) {
        return;
    }

    fetch('../newPhpfileTechhub/likes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `userid=${postId}&vote=${voteType}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            document.getElementById('likes_' + postId).innerHTML = 'Votes: ' + data.newCount;
            button.classList.add('voted');
            
            // Disable both buttons after voting
            document.getElementById('upbtn_' + postId).classList.add('disabled');
            document.getElementById('downbtn_' + postId).classList.add('disabled');
            
            // Change color based on vote type
            if(voteType === 'up') {
                button.querySelector('i').style.color = '#2ecc71';
            } else {
                button.querySelector('i').style.color = '#e74c3c';
            }
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
<style>
.like-section {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px 0;
}

.vote-btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-size: 1.2rem;
}

.vote-btn i {
    transition: transform 0.2s ease;
    color: #64748b; /* Modern slate color */
}

/* Hover effects */
.vote-btn:hover i {
    transform: scale(1.2);
}

.vote-btn:hover i.fa-thumbs-up {
    color: #3b82f6; /* Modern blue */
}

.vote-btn:hover i.fa-thumbs-down {
    color: #ef4444; /* Modern red */
}

/* Voted states */
.vote-btn.voted i.fa-thumbs-up {
    color: #3b82f6; /* Modern blue */
}

.vote-btn.voted i.fa-thumbs-down {
    color: #ef4444; /* Modern red */
}

.disabled {
    pointer-events: none;
    opacity: 0.6;
}

.vote-count {
    font-size: 0.95rem;
    color: #64748b;
    font-weight: 500;
    min-width: 80px;
}


/* Option 2: Slight transparency */
.vote-btn:hover {
    background-color: rgba(0, 0, 0, 0.05);
}
</style>