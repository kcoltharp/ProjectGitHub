Public Class Form1
    'This program is missing lots of comments, make sure it is full of comments
    Private Sub menuClear_Click(sender As System.Object, e As System.EventArgs) Handles menuClear.Click
        lblOutput.Text = ""
        lstOutputs.Items.Clear()
        Button1.Enabled = True
    End Sub

    Private Sub Button1_Click(sender As System.Object, e As System.EventArgs) Handles Button1.Click
        Const cnumUpperLimit As Integer = 5
        Const cnumLowerLimit As Integer = 1

        Dim counterVariable As Integer
        Dim accumulatorVariable As Integer = 0
        Dim numEntryVariable As Integer

        Dim strEntryVariable As String = "0"
        Dim labelOutput As String = "Your total number is: "

        counterVariable = cnumLowerLimit

        Do While counterVariable <= cnumUpperLimit
            strEntryVariable = InputBox("Give me number " & counterVariable)

            If IsNumeric(strEntryVariable) = False Then
                counterVariable = cnumUpperLimit + 1
            Else
                lstOutputs.Items.Add(strEntryVariable)
                numEntryVariable = Convert.ToInt32(strEntryVariable)

                accumulatorVariable += numEntryVariable

                counterVariable += 1
            End If
        Loop

        labelOutput &= accumulatorVariable.ToString
        lblOutput.Text = labelOutput
        Button1.Enabled = False

    End Sub

    Private Sub Button2_Click(sender As System.Object, e As System.EventArgs) Handles btnClear.Click
        lblOutput.Text = ""
        lstOutputs.Items.Clear()
        Button1.Enabled = True
    End Sub

    Private Sub btnExit_Click(sender As System.Object, e As System.EventArgs) Handles btnExit.Click
        Close()
    End Sub

    Private Sub menuExit_Click(sender As System.Object, e As System.EventArgs) Handles menuExit.Click
        Close()
    End Sub

    Private Sub Form1_Load(sender As System.Object, e As System.EventArgs) Handles MyBase.Load
        lblOutput.Text = ""
        lstOutputs.Items.Clear()
    End Sub
End Class
