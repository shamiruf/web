<?php

/**
 * Print parts of book 
 * 
 * @param var $book book
 * @param array $addedBooksIds array of the added books ids
 * @param boolean $showFull if it true, then show full title of book
 * @param boolean $showDeleteButton if it true then show delete button
 */

function printBook($book, $addedBooksIds = array(), $showFull = false, $showDeleteButton = false) { ?>
        <!-- BOOK BLOCK -->
            <div class="book">
                <div class="book-img">
                    <img
                        class="book1" 
                        src="<?php echo $book['img']; ?>"
                        alt="<?php echo $book['title']; ?>"
                        title="Book <?php echo $book['title']; ?>"
                    />
                </div>
                <div class="book-title">
                    <h4 class="book-name"><?php echo $book['title']; ?></h4>
                    
                    Author: <?php echo $book['author']; ?>
                    <br>
                    Genre: <?php echo $book['genre']; ?>
                    <br>
                    Publication date: <?php echo $book['date']; ?>
                    <br>Rating: <?php echo $book['rating']; ?>
                    <br><br>
                    <?php if ($showFull) : ?>
                        <p><?php echo $book['description']; ?></p>
                    <?php endif; ?>
                    <div class="bttn">
                        <?php if (!$showFull) : ?>
                            <a class="bttn-about-book" href="read_book.php?id=<?php echo $book['id']; ?>">About book</a>
                        <?php endif; ?>

                        <?php if ($GLOBALS['isLoggedIn']) :
                                if (!$showDeleteButton) : ?>
                                <?php if (!in_array($book['id'], $addedBooksIds)) { ?>
                                    <a
                                        class="bttn-read add-user-book-button"
                                        href="add_user_book.php?id=<?php echo $book['id']; ?>"
                                        data-bookid="<?php echo $book['id']; ?>"
                                    >
                                        Add book
                                    </a>
                                <?php } ?>
                            <?php else : ?>
                                <a class="bttn-read" href="delete_user_book.php?id=<?php echo $book['id']; ?>">Delete book</a>
                            <?php endif;
                        endif; ?>
                    </div>
                </div>
            </div>
        <!-- END BOOK BLOCK -->
<?php } ?>
