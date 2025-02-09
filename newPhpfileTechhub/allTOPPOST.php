<?php
include_once "../database.php";

$sql4 = mysqli_query($connect, "SELECT * FROM newsfeed WHERE react > 2000 ORDER BY react DESC, postdate DESC");





// // Debug: Print the queries being executed
// $sql7 = mysqli_query($connect, "SELECT * FROM newsfeed WHERE react >= 4000");
// $sql6 = mysqli_query($connect, "SELECT * FROM newsfeed WHERE react >= 3000");
// $sql5 = mysqli_query($connect, "SELECT * FROM newsfeed WHERE react >= 2000");



// // Process each post with 4000+ reactions
// while ($row7 = mysqli_fetch_assoc($sql7)) {
//     $updateRank = mysqli_query($connect, 
//         "UPDATE ranking 
//         SET ranks = 'SENIOR DEV' 
//         WHERE rank_id = '{$row7['userid']}'");
    
//     // Debug: Print update result
//     echo "Updating to SENIOR DEV for user {$row7['userid']}: " . ($updateRank ? 'Success' : mysqli_error($connect)) . "<br>";
// }

// // Process each post with 3000+ reactions
// while ($row6 = mysqli_fetch_assoc($sql6)) {
//     $updateRank = mysqli_query($connect, 
//         "UPDATE ranking 
//         SET ranks = 'MID DEV' 
//         WHERE rank_id = '{$row6['userid']}'");
    
//     // Debug: Print update result
//     echo "Updating to MID DEV for user {$row6['userid']}: " . ($updateRank ? 'Success' : mysqli_error($connect)) . "<br>";
// }

// // Process each post with 2000+ reactions
// while ($row5 = mysqli_fetch_assoc($sql5)) {
//     $updateRank = mysqli_query($connect, 
//         "UPDATE ranking 
//         SET ranks = 'JUNIOR DEV' 
//         WHERE rank_id = '{$row5['userid']}'");
    
//     // Debug: Print update result
//     echo "Updating to JUNIOR DEV for user {$row5['userid']}: " . ($updateRank ? 'Success' : mysqli_error($connect)) . "<br>";
// }

for ($x = 0; $row3 = mysqli_fetch_assoc($sql4); $x++) {

    
?>
    <div id="allpost">
        <div class="feedname">
            <?php
            // Update the rank based on the react count of the current post
            if ($row3['react'] > 4000) {
                $updateRank = mysqli_query($connect, "UPDATE ranking SET ranks = 'SENIOR DEV' WHERE rank_id = '{$row3['userid']}'");
            } elseif ($row3['react'] > 3000) {
                $updateRank = mysqli_query($connect, "UPDATE ranking SET ranks = 'MID-LEVEL' WHERE rank_id = '{$row3['userid']}'");
            } elseif ($row3['react'] > 2000) {
                $updateRank = mysqli_query($connect, "UPDATE ranking SET ranks = 'JUNIOR DEV' WHERE rank_id = '{$row3['userid']}'");
            }
            ?>
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
/* Updated styles for a more modern look */
.like-section {
    display: flex;
    align-items: center;
    gap: 20px; /* Increased gap for better spacing */
    padding: 12px 0; /* Slightly increased padding */
}

.vote-btn {
    background: #f0f0f0; /* Light background for buttons */
    border: none;
    cursor: pointer;
    padding: 10px 15px; /* Increased padding for a larger button */
    border-radius: 12px; /* More rounded corners */
    transition: all 0.3s ease; /* Smoother transition */
    font-size: 1.2rem;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

/* Updated icon color and transition */
.vote-btn i {
    transition: transform 0.3s ease, color 0.3s ease; /* Smooth color transition */
    color: #64748b; /* Modern slate color */
}

/* Hover effects */
.vote-btn:hover {
    background-color: #e0e0e0; /* Light gray background on hover */
}

.vote-btn:hover i {
    transform: scale(1.3); /* Slightly larger scale on hover */
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
    opacity: 0.5; /* Slightly more transparent when disabled */
}

.vote-count {
    font-size: 1rem; /* Increased font size for better readability */
    color: #64748b;
    font-weight: 600; /* Bolder font weight */
    min-width: 80px;
}
</style>