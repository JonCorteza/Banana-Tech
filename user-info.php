<?php include_once('layout/head.php');
?>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title" >INFORMATION</strong>
                    </div>

                    <p id="getUID" hidden></p>

                    <br>

                    <div id="show_user_data">
                        <form>
                            <table id="refreshMoto" width="470" border="1" bordercolor="#10a0c5" align="center" cellpadding="1" cellspacing="1" bgcolor="#000" style="padding: 2px">
                                <tr>
                                    <td height="40" align="center" bgcolor="#10a0c5"><font color="#FFFFFF">
                                            <b id="">  Your Information</b>
                                        </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#f9f9f9">
                                        <?php
                                        $rfidno = db_get_result('tbl_constants', 'value', ['category' => 'RFID']);
                                        $result = my_query("SELECT *  FROM tbl_users  WHERE id ='$user_id'     ");
                                        if ($row = $result->fetch()) { ?>
                                            <table width="470" border="0" align="center" cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td width="113" align="left" class="lf"> </td>
                                                    <td style="font-weight:bold">  </td>
                                                    <td align="left"> <img width="80%" src="../images/user/<?= $row['pic']; ?>"/></td>
                                                </tr>
                                                <tr>
                                                    <td width="113" align="left" class="lf">Card Type</td>
                                                    <td style="font-weight:bold">: </td>
                                                    <td align="left"> <?=$row['card_type'];?></td>
                                                </tr>
                                                <tr>
                                                    <td width="113" align="left" class="lf">ID</td>
                                                    <td style="font-weight:bold">: </td>
                                                    <td align="left"> <?=$row['userNo'];?></td>
                                                </tr>
                                                <tr bgcolor="#f2f2f2">
                                                    <td align="left" class="lf">Plate Number</td>
                                                    <td style="font-weight:bold">:</td>
                                                    <td align="left">  <?=$row['plate_no'];?> </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="lf">Profile</td>
                                                    <td style="font-weight:bold">:</td>
                                                    <td align="left">  <?=$row['fname'];?> </td>
                                                </tr>
                                                <tr bgcolor="#f2f2f2">
                                                    <td align="left" class="lf">Email</td>
                                                    <td style="font-weight:bold">:</td>
                                                    <td align="left">  <?=$row['email'];?> </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="lf">Mobile Number</td>
                                                    <td style="font-weight:bold">:</td>
                                                    <td align="left">  <?=$row['contact'];?> </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="lf">Card  Balance</td>
                                                    <td style="font-weight:bold">:</td>
                                                    <td align="left">  <?=$row['balance_amount'];?> </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" class="lf">   Parking </td>
                                                    <td style="font-weight:bold">:</td>
                                                    <td align="left">  <?php
                                                        $id=$row['id'];
                                                        $result = my_query("SELECT park_code,lat,lng  FROM tbl_parks  WHERE user_id ='$id'     ");
                                                        if ($row = $result->fetch()) { ?>
                                                            <a target="_blank" class="btn btn-info" href="https://www.google.com/maps/dir/?api=1&destination=<?= $row['lat']; ?>%2C<?= $row['lng']; ?>"><?= $row[0];?> View
                                                                Direction</a>
                                                        <?php   }?>
                                                        </td>
                                                </tr>
                                            </table>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <br/><br/><br/>

                </div>
            </div>
        </div>
    </div>
</div>
</div>



<?php include_once('layout/footer.php'); ?>


<script>

    var blink = document.getElementById('blink');
    setInterval(function () {
        blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
    }, 750);
</script>


</body>
</html>